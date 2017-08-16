Entities - сущьности. Это наши сущьности, в основном описывают таблицы,
какие поля и методы для сохранения редактирования или создания.
Наследуют ActiveRecord общаются в основном с репозиториями который
говорит им что вытянуть и что когда сохранить.
----------
**FOR EXAMPLE** пример описания сущьности
```
/**
 * Class Entity
 * @package shop\entities\Entity
 * документируем колонки в таблице нашей сущьности
 * @property integer $id
 * @property string $name
 * @property string $slug
 */
class Entity extends ActiveRecord
{
    //статический метод принимает параметры для создания записи,
    //создает обьект сам из себя и заполняет ими свои свойства, возвращает
    //себя заполненным 
    public static function create($name, $slug): self
    {
        $tag = new static();
        $tag->name = $name;
        $tag->slug = $slug;
        return $tag;
    }

    //метод принимает параметры для редактирования записи,
    //и заполняет ими свои свойства
    public function edit($name, $slug): void
    {
        $this->name = $name;
        $this->slug = $slug;
    }

    //метод возвращает названия таблицы сущьности
    public static function tableName(): string
    {
        return '{{%shop_tags}}';
    }

}
```