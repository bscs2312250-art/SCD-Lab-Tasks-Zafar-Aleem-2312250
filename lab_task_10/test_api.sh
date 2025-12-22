#!/bin/bash

BASE_URL="http://127.0.0.1:8000/api/products"

echo "---------------------------------------------------"
echo "1. Testing POST (Create Product)"
echo "Request: POST $BASE_URL"
echo "Data: {\"name\":\"Laravel Book\",\"description\":\"Advanced Laravel Guide\",\"price\":29.99,\"stock\":50,\"category\":\"Books\"}"
RESPONSE=$(curl -s -X POST $BASE_URL \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Laravel Book","description":"Advanced Laravel Guide","price":29.99,"stock":50,"category":"Books"}')
echo "Response:"
echo $RESPONSE
echo "---------------------------------------------------"
echo ""

# Extract ID if possible, otherwise assume 1
ID=1

echo "---------------------------------------------------"
echo "2. Testing GET (Read All)"
echo "Request: GET $BASE_URL"
RESPONSE=$(curl -s -X GET $BASE_URL -H "Accept: application/json")
echo "Response:"
echo $RESPONSE
echo "---------------------------------------------------"
echo ""

echo "---------------------------------------------------"
echo "3. Testing GET (Read Single ID: $ID)"
echo "Request: GET $BASE_URL/$ID"
RESPONSE=$(curl -s -X GET $BASE_URL/$ID -H "Accept: application/json")
echo "Response:"
echo $RESPONSE
echo "---------------------------------------------------"
echo ""

echo "---------------------------------------------------"
echo "4. Testing PUT (Update ID: $ID)"
echo "Request: PUT $BASE_URL/$ID"
echo "Data: {\"price\":19.99}"
RESPONSE=$(curl -s -X PUT $BASE_URL/$ID \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"price":19.99}')
echo "Response:"
echo $RESPONSE
echo "---------------------------------------------------"
echo ""

echo "---------------------------------------------------"
echo "5. Testing DELETE (Destroy ID: $ID)"
echo "Request: DELETE $BASE_URL/$ID"
RESPONSE=$(curl -s -X DELETE $BASE_URL/$ID -H "Accept: application/json")
echo "Response:"
echo $RESPONSE
echo "---------------------------------------------------"
echo ""

echo "---------------------------------------------------"
echo "6. Verifying Deletion (Get ID: $ID)"
echo "Request: GET $BASE_URL/$ID"
RESPONSE=$(curl -s -X GET $BASE_URL/$ID -H "Accept: application/json")
echo "Response:"
echo $RESPONSE
echo "---------------------------------------------------"
