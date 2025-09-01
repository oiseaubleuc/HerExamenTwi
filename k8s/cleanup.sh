#!/bin/bash

echo "🧹 Cleaning up Mini Twitter from Kubernetes..."

if ! command -v kubectl &> /dev/null; then
    echo " kubectl is not installed or not in PATH"
    exit 1
fi

echo " Deleting all resources..."
kubectl delete -f 08-ingress.yaml --ignore-not-found=true
kubectl delete -f 09-migrations-job.yaml --ignore-not-found=true
kubectl delete -f 07-services.yaml --ignore-not-found=true
kubectl delete -f 06-nginx-configmap.yaml --ignore-not-found=true
kubectl delete -f 05-nginx-deployment.yaml --ignore-not-found=true
kubectl delete -f 04-deployment.yaml --ignore-not-found=true
kubectl delete -f 03-pvc.yaml --ignore-not-found=true
kubectl delete -f 02-secret.yaml --ignore-not-found=true
kubectl delete -f 01-configmap.yaml --ignore-not-found=true

echo "Waiting for resources to be deleted..."
sleep 10

echo "Deleting namespace..."
kubectl delete namespace mini-twitter --ignore-not-found=true

echo ""
echo "Cleanup complete!"
echo "   All Mini Twitter resources have been removed from Kubernetes"
