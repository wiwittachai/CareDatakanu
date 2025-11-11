# ใช้ PHP 8.2 เป็น base image
FROM php:8.2-cli

# ตั้ง working directory
WORKDIR /app

# คัดลอกไฟล์ทั้งหมดจาก repo ไปใน container
COPY . /app

# เปิดพอร์ตให้ Render ใช้
EXPOSE 10000

# สั่งให้รัน PHP server โดยเปิดไฟล์ ai_api.php
CMD ["php", "-S", "0.0.0.0:10000", "ai_api.php"]
