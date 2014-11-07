SluggableBehavior
=================

Bỏ dấu Tiếng Việt và tạo friendly link trước khi lưu vào database. Behavior apply for Cakephp 3.x

## 1) Bước 1:
Copy file SluggableBehavior vào thư mục /your_project/src/Model/Behavior/
Hoặc sử dụng composer:
Copy dòng sau vào composer.json của cakephp 3.x
```
"require-dev": {
        "crabstudio/sluggablebehavior": "dev-master"
}
```
Sau đó save lại và thực thi lệnh: composer update

## 2) Bước 2:
Mở Model Table mà bạn muốn gán slug ra và thêm vào function initialize dòng sau:
Chú ý:
Nếu Model table của bạn đã có field là title, slug là slug, và sử dụng dấu gạch ngang để cách giữa các từ, tên hàm giữ nguyên theo mặc định thì các bạn chỉ cần khai báo như sau:

```
        $this->addBehavior('Sluggable');
```

Dưới đây là khai báo chi tiết, các bạn có thể tùy biến theo ý các bạn.

```
        $this->addBehavior('Sluggable', [
            'field' => 'title',
            'slug' => 'slug',
            'replacement' => '-', 
            'implementedFinders' => [
                'slugged' => 'findSlug',
                'check' => 'checkExist']
        ]);
```

```
Trong đó:
  field: tên của trường dữ liệu gốc.
  slug: tên của trường sẽ lưu chuỗi slugged
  replacement: ký tự nối giữa các từ trong chuỗi slug
  slugged: Tên alias của function fundSlug, bạn có thể đặt tên khác. VD: 'friendlyName' => 'findSlug'
  check: Tên alias của function checkExist, bạn có thể đặt tên khác. VD: 'checkExisting' => 'checkExist'
  Function check này mục đích để kiểm tra xem đã có slug nào trước đó trùng với slug bạn sẽ thêm vào hay chưa (unique slug)
```
Để gọi function slugged, check (gọi tới tên alias của function) này các bạn dùng như sau: (Các bạn có thể gọi bất cứ đâu dùng TableRegistry, hoặc loadModel)

```
$article = \Cake\ORM\TableRegistry::get('Articles')->find('slugged', ['slug' => 'Cach-lam-link-than-thien'])->first();
or
$this->loadModel('Articles');
$article = $this->Articles->find('slugged', ['slug' => 'Cach-lam-link-than-thien'])->first();

$isExist = $this->Articles->find('check', ['slug' => 'Cach-lam-link-than-thien'])->first();
if($isExist)
        do_some_thing;
else
        save entity;
```
