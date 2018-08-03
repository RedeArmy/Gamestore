sleep 5
if curl 54.198.123.203/page/Webpage/index.php | grep -q '<b>visitado:</b>'; then
  echo "Tests failed!"
  exit 1
else
  echo "Tests passed!"
  exit 0
fi
