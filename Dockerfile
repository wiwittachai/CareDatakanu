# ใช้ PHP เวอร์ชันล่าสุด
FROM php:8.2-cli

# ติดตั้ง cURL เพื่อเรียก API
RUN apt-get update && apt-get install -y curl

# คัดลอกไฟล์ทั้งหมดเข้า container
COPY . /app
WORKDIR /app

# เปิดเซิร์ฟเวอร์ PHP (Render ต้องใช้พอร์ต 10000)
CMD ["php", "-S", "0.0.0.0:10000", "-t", "/app"]
