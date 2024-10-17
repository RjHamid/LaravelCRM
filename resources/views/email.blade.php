<!DOCTYPE html>  
<html lang="fa">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Confirmation Code</title>  
    <style>  
        body {  
            font-family: Arial, sans-serif;  
            background-color: #f4f4f4;  
            padding: 20px;  
            margin: 0;  
        }  
        .container {  
            max-width: 600px;  
            margin: auto;  
            background: #fff;  
            padding: 20px;  
            border-radius: 5px;  
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);  
        }  
        .code {  
            font-size: 24px;  
            font-weight: bold;  
            color: #007BFF;  
        }  
        h2 {  
            color: #333;  
        }  
        p {  
            font-size: 16px;  
            line-height: 1.5;  
            color: #555;  
        }  
    </style>  
</head>  
<body>  
    <div class="container">  
        <h2>کد تایید شما</h2>  
        <p>کد تایید شما برای ورود به سیستم: <span class="code">{{ $code }}</span></p>  
        <p>لطفاً این کد را در فرم مربوطه وارد کنید. این کد تنها برای 5 دقیقه معتبر است.</p>  
    </div>  
</body>  
</html>