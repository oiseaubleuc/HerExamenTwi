#!/bin/bash

echo " Deploying Twitterclone naar Kubernetes..."

if ! command -v kubectl &> /dev/null; then
    echo " kubectl is not installed or not in PATH"
    exit 1
fi

if ! kubectl cluster-info &> /dev/null; then
    echo "No Kubernetes cluster found. Please start k3d first:"
    echo "   k3d cluster create mini-twitter"
    exit 1
fi

echo " Kubernetes cluster found"

echo "Creating namespace..."
kubectl apply -f 00-namespace.yaml

kubectl wait --for=condition=Active namespace/mini-twitter --timeout=30s

echo "Applying configurations..."
kubectl apply -f 01-configmap.yaml
kubectl apply -f 02-secret.yaml
kubectl apply -f 03-pvc.yaml

echo "Waiting for storage to be ready..."
kubectl wait --for=condition=Bound pvc/mini-twitter-db-pvc -n mini-twitter --timeout=60s

echo "Deploying applications..."
kubectl apply -f 04-deployment.yaml
kubectl apply -f 05-nginx-deployment.yaml
kubectl apply -f 06-nginx-configmap.yaml
kubectl apply -f 07-services.yaml

echo "Waiting for deployments to be ready..."
kubectl wait --for=condition=available --timeout=300s deployment/mini-twitter-app -n mini-twitter
kubectl wait --for=condition=available --timeout=300s deployment/mini-twitter-nginx -n mini-twitter

echo "Running database migrations..."
kubectl apply -f 09-migrations-job.yaml

echo "Waiting for migrations to complete..."
kubectl wait --for=condition=complete --timeout=300s job/mini-twitter-migrations -n mini-twitter

echo "Setting up ingress..."
kubectl apply -f 08-ingress.yaml

echo "Getting service information..."
kubectl get services -n mini-twitter

echo ""
echo "Deployment complete!"
echo ""
echo " To access your app:"
echo "   kubectl port-forward -n mini-twitter service/mini-twitter-nginx-service 8080:80"
echo ""
echo "Check status with:"
echo "   kubectl get all -n mini-twitter"
echo ""
echo "View logs with:"
echo "   kubectl logs -n mini-twitter deployment/mini-twitter-app"
echo "   kubectl logs -n mini-twitter deployment/mini-twitter-nginx"
