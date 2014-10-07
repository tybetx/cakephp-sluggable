SluggableBehavior
=================

Bỏ dấu Tiếng Việt và tạo friendly link trước khi lưu vào database. Behavior apply for Cakephp 3.x

## 1) Bước 1:
Copy file SluggableBehavior vào thư mục /your_project/src/Model/Behavior/

## 2) Bước 2:
Mở Model Table mà bạn muốn gán slug ra và thêm vào function initialize dòng sau:

```
        $this->addBehavior('Sluggable', [
            'field' => 'title',
            'slug' => 'slug',
            'replacement' => '-', 
            'implementedFinders' => [
                'slugged' => 'findSlug']
        ]);
```

```
Trong đó:
  field: tên của trường dữ liệu gốc.
  slug: tên của trường sẽ lưu chuỗi slugged
  replacement: ký tự nối giữa các từ trong chuỗi slug
  slugged: Tên bí danh của function fundSlug, bạn có thể đặt khác. VD: 'friendlyName' => 'findSlug'
```
Để gọi function slugged này các bạn dùng như sau: (Các bạn có thể gọi bất cứ đâu dùng TableRegistry, hoặc loadModel)

```
$article = \Cake\ORM\TableRegistry::get('Articles')->find('slugged', ['slug' => 'Cach-lam-link-than-thien'])->first();
or
$this->loadModel('Articles');
$article = $this->Articles->find('slugged', ['slug' => 'Cach-lam-link-than-thien'])->first();
```
