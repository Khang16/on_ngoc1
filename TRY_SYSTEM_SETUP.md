# Hướng dẫn thiết lập hệ thống Try

## 📋 Bước 1: Tạo Post Type "Try" trong ACF

1. **Vào WordPress Admin → Custom Fields → Post Types**
2. **Click "Add New"**
3. **Cài đặt:**
   - **Post Type Key:** `try`
   - **Plural Label:** `Tries`
   - **Singular Label:** `Try`
   - **Description:** `Post type for try content`

4. **Settings tab:**
   - ✅ **Public:** Yes
   - ✅ **Publicly Queryable:** Yes
   - ✅ **Show UI:** Yes
   - ✅ **Show in Menu:** Yes
   - ✅ **Show in Nav Menus:** Yes
   - ✅ **Show in Admin Bar:** Yes
   - ✅ **Show in REST API:** Yes
   - ✅ **Has Archive:** Yes
   - **Menu Position:** 5
   - **Menu Icon:** dashicons-admin-generic
   - **Supports:** Title, Editor, Thumbnail, Excerpt

5. **Click "Publish"**

## 📂 Bước 2: Tạo Taxonomy "Try Categories" trong ACF

1. **Vào WordPress Admin → Custom Fields → Taxonomies**
2. **Click "Add New"**
3. **Cài đặt:**
   - **Taxonomy Key:** `try-categories`
   - **Plural Label:** `Try Categories`
   - **Singular Label:** `Try Category`
   - **Description:** `Categories for try posts`

4. **Settings tab:**
   - ✅ **Public:** Yes
   - ✅ **Publicly Queryable:** Yes
   - ✅ **Show UI:** Yes
   - ✅ **Show in Menu:** Yes
   - ✅ **Show in Nav Menus:** Yes
   - ✅ **Show Tag Cloud:** Yes
   - ✅ **Show in REST API:** Yes
   - ✅ **Hierarchical:** Yes
   - **Object Types:** Select "Try" (post type vừa tạo)

5. **Click "Publish"**

## 🔧 Bước 3: Thêm Custom Fields cho Try (Tùy chọn)

1. **Vào WordPress Admin → Custom Fields → Field Groups**
2. **Click "Add New"**
3. **Tên:** "Try Fields"
4. **Thêm các fields theo nhu cầu:**
   - **Featured Video:** URL field cho video
   - **Duration:** Text field cho thời lượng
   - **Difficulty:** Select field (Easy, Medium, Hard)
   - **Tags:** Text field cho tags

5. **Location Rules:**
   - **Post Type** is equal to **Try**

6. **Click "Publish"**

## 📝 Bước 4: Tạo nội dung mẫu

1. **Vào WordPress Admin → Tries → Add New**
2. **Tạo vài Try Categories:**
   - Vào **Tries → Try Categories**
   - Thêm categories như: "Basic", "Intermediate", "Advanced"

3. **Tạo vài Try posts:**
   - Thêm title, content, featured image
   - Assign categories
   - Điền custom fields (nếu có)

## 🎨 Bước 5: Kiểm tra templates

### URLs sẽ hoạt động:
- **Archive Try:** `yoursite.com/try/`
- **Category archive:** `yoursite.com/try-categories/basic/`
- **Single try:** `yoursite.com/try/your-try-title/`

### Template files được sử dụng:
- `archive-try.php` - Archive try posts
- `taxonomy-try-categories.php` - Try category archives
- `single-try.php` - Single try post (sẽ tạo nếu cần)
- `template-parts/try/grid-items/` - Grid layout components

## 🔌 Bước 6: Sử dụng Shortcodes

### Try Grid Shortcode:
```php
// Hiển thị tất cả try posts
[try_grid]

// Hiển thị 8 posts per page
[try_grid posts_per_page="8"]

// Hiển thị category cụ thể
[try_grid category="basic"]

// Ẩn filters và search
[try_grid show_filters="false" show_search="false"]
```

### Try Categories Shortcode:
```php
// Hiển thị tất cả categories
[try_categories]

// Hiển thị với số lượng posts
[try_categories show_count="true"]

// Chỉ hiển thị parent categories
[try_categories parent="0"]
```

## 🎯 Bước 7: Customization

### Chỉnh sửa CSS:
- File: `template-parts/try/grid-items/assets/styles.css`
- Customize grid layout, colors, spacing

### Chỉnh sửa JavaScript:
- File: `template-parts/try/grid-items/assets/scripts.js`
- Customize filtering behavior, animations

### Chỉnh sửa Template:
- `template-parts/try/grid-items/index.php` - Main grid template
- `template-parts/try/grid-items/item-loop.php` - Individual item template

## 🔍 Troubleshooting

### Nếu archive page không hiển thị:
1. Vào **Settings → Permalinks**
2. Click "Save Changes" để flush rewrite rules

### Nếu CSS/JS không load:
1. Check file paths trong `inc/functions.php`
2. Clear cache nếu sử dụng caching plugin

### Nếu AJAX không hoạt động:
1. Check console cho JavaScript errors
2. Verify nonce trong `inc/ajax.php`

## 📞 Support

Nếu gặp vấn đề, check:
1. WordPress error logs
2. Browser console errors
3. ACF field configurations
4. Template file paths

---

**✅ Sau khi hoàn thành tất cả bước trên, hệ thống Try sẽ hoạt động độc lập với hệ thống Extends hiện tại.**
