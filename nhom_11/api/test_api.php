<!DOCTYPE html>
<html>
<head>
    <title>Test API</title>
</head>
<body>
    <h2>Test kết nối API</h2>
    <button onclick="testAPI()">Test API Login</button>
    <pre id="result"></pre>
    
    <script>
        async function testAPI() {
            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = 'Đang kết nối...';
            
            try {
                const response = await fetch('http://localhost/nhom_11/api/api_login.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        email: 'hungtic21@gmail.com',
                        password: '123456'  // Thay bằng mật khẩu thật
                    })
                });
                
                const result = await response.json();
                resultDiv.innerHTML = JSON.stringify(result, null, 2);
            } catch (error) {
                resultDiv.innerHTML = 'Lỗi: ' + error.message;
            }
        }
    </script>
</body>
</html>