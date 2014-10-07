SluggableBehavior
=================

Bỏ dấu Tiếng Việt và tạo friendly link trước khi lưu vào database. Behavior apply for Cakephp 3.x
## 1) Copy file SluggableBehavior vào thư mục /your_project/src/Model/Behavior/
## 2) Mở Model Table mà bạn muốn gán slug ra và thêm vào initialize dòng sau:
```
        $this->addBehavior('Sluggable', [
            'field' => 'title',
            'slug' => 'slug',
            'replacement' => '-',
        ]);
```

```
Trong đó:
  field: tên của trường dữ liệu gốc.
  slug: tên của trường sẽ lưu chuỗi slugged
  replacement: ký tự nối giữa các từ trong chuỗi slug
```
