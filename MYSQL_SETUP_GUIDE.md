# دليل تشغيل MySQL - حل مشكلة الاتصال

## المشكلة
```
SQLSTATE[HY000] [2002] No connection could be made because the target machine actively refused it
```

هذا يعني أن MySQL غير قيد التشغيل.

---

## الحلول السريعة

### ✅ الحل 1: استخدام XAMPP (الأسهل والأسرع)

1. **تحميل XAMPP:**
   - اذهب إلى: https://www.apachefriends.org/download.html
   - حمّل النسخة المناسبة لنظامك (Windows)
   - ثبّت XAMPP

2. **تشغيل MySQL:**ت
   - افتح **XAMPP Control Panel**
   - اضغط **Start** بجانب **MySQL**
   - يجب أن يتحول إلى اللون الأخضر

3. **إنشاء قاعدة البيانات:**
   - افتح المتصفح واذهب إلى: http://localhost/phpmyadmin
   - اضغط على **New** في القائمة الجانبية
   - أدخل اسم قاعدة البيانات: `OxfordPlatform`
   - اختر **utf8mb4_unicode_ci** كـ Collation
   - اضغط **Create**

4. **التحقق من الإعدادات:**
   - تأكد من أن ملف `.env` يحتوي على:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=OxfordPlatform
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **تشغيل Migrations:**
   ```bash
   php artisan migrate
   ```

---

### ✅ الحل 2: استخدام Laragon (موصى به للمطورين)

1. **تحميل Laragon:**
   - اذهب إلى: https://laragon.org/download/
   - حمّل Laragon Full أو Mini
   - ثبّت Laragon

2. **تشغيل Laragon:**
   - افتح Laragon
   - اضغط **Start All** (أو اضغط F10)
   - سيتم تشغيل MySQL و Apache تلقائياً

3. **إنشاء قاعدة البيانات:**
   - افتح http://localhost/phpmyadmin
   - أنشئ قاعدة بيانات باسم `OxfordPlatform`

---

### ✅ الحل 3: تثبيت MySQL مباشرة

1. **تحميل MySQL:**
   - اذهب إلى: https://dev.mysql.com/downloads/installer/
   - حمّل **MySQL Installer for Windows**

2. **التثبيت:**
   - اختر **Developer Default**
   - اختر **Install as Windows Service**
   - **Port:** 3306
   - **Root Password:** (اتركه فارغاً أو ضع كلمة مرور)
   - أكمل التثبيت

3. **تشغيل MySQL:**
   - اذهب إلى **Services** (Win + R → services.msc)
   - ابحث عن **MySQL80** أو **MySQL**
   - اضغط **Start**

---

## التحقق من أن MySQL يعمل

بعد تشغيل MySQL، اختبر الاتصال:

```bash
php artisan migrate:status
```

إذا نجح الأمر، فالمشكلة حُلت! ✅

---

## نصائح إضافية

- **إذا كان المنفذ 3306 مستخدم:**
  - غيّر `DB_PORT` في ملف `.env` إلى `3307` أو أي منفذ آخر
  - أو أوقف البرنامج الذي يستخدم المنفذ 3306

- **إذا كانت كلمة مرور MySQL موجودة:**
  - أضفها في ملف `.env`:
  ```
  DB_PASSWORD=your_password
  ```

- **لإعادة تشغيل Laravel بعد تغيير .env:**
  ```bash
  php artisan config:clear
  php artisan cache:clear
  ```

---

## المساعدة

إذا استمرت المشكلة، تأكد من:
1. ✅ MySQL قيد التشغيل
2. ✅ قاعدة البيانات `OxfordPlatform` موجودة
3. ✅ إعدادات `.env` صحيحة
4. ✅ المنفذ 3306 متاح

