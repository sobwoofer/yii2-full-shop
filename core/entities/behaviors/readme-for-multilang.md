После создания сультиязычной сущности в entities
1. Прописываем 'ml' в метод behaviors 
``` 
'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => false,
                'langClassName' => CategoryLang::className(),
                'langForeignKey' => 'category_id',
                'tableName' => '{{%shop_categories_lang}}',
                'attributes' => [
                    'name', 'title', 'description', 'meta'
                ]
            ],
```
в attributes указываем мультиязычные поля которых не должно быть
в таблице самой сущности а должны быть в таблице ее переводов
table_name_lang - у которой праймари кей ссылается на таблицу сущности
все это прописываем в конфиге поведения 'ml' при его подключения 
в сущность.
2. В мультиязычной сущности должен быть переопределен метод 
find таким образом
``` 
public static function find(): CategoryQuery
    {
        return new CategoryQuery(static::class);
    }
```
если уже переопределен и юзает свой query класс то пихаем в него
трейт мультиязычного екстеншена  use MultilingualTrait;
2. Создаем клас в entities для переводов сущности, в его бихевиор
пихаем мета поведение и в проперти public $meta если токово имеется.
Метод tableName и все.
3. в формах сервисах и вьюхах ихаем такой метод отображения и заполнения
данных
```
foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
    $this->{'name' . $suffix} = $category->{'name' . $suffix};
}
```
потому что стандартный язык который дефортный в таблице lang
в этом случае будет в проперти $this->name а все остальные в проперти
$this->name_ua, $this->name_en и тп.. все создается динамически 
геттеры и сеттеры рулят.
4. В формах не забываем прописывать все виртуальные поля в rules
чтобы не гадить я специально создал LangsHelper он возвратит
массив из одного или нескольких мультиязычных полей методом
getNamesWithSuffix в зависимости от текущих языков.
5. Также не забываем прописывать поля виртуальных вложеных форм в
 internalForms в классе формы если вложенные формы мультиязычные.
6. Если мультиязычная форма не наследует класс CompositeForm
но наследует класс Model
в єтом случае нужно переопределить геттеры и сеттеры чтобы 
получилось чтото типа
```
    public function __set($name, $value)
    {
        $this->$name = $value;
        return; //for can set dynamic multi language property
//        parent::__set($name, $value);
    }

    public function __get($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            // read property, e.g. getName()
            return $this->$getter();
        }

        return $this->$name = ''; //for can set dynamic multi language property
//        return parent::__get($name);
    }
```
для того чтобы можно было динамически создать свойство обьекта после 
создания самого обьекта.
7. Не забываем в контроллерах и репозиториях использовать метод
multilingual() 
```
Entity::find()->multilingual()->andWhere(['id' => $id])->one()
```
только в этом случае будет работать выборка всех языков по типу 
суффикса после проперти обьекта сущьности.
8. Для сортировки и поиска в ActiveDataProvider нужно вытягивать данные
таким образом
```
$query = Brand::find()->joinWith('translation');
```
