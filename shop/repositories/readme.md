Репозитории это набор таких себе простеньких методов которые умеют принять 
какие то данные и по ним запрашивать либо записывать информацию
в сущьность(entities). Что нибудь вытянуть по id либо еще чему то
или бросить исключение в случае ошибки записи.. все это делается сдесь.
----------
**FOR EXAMPLE** пример простого репозитория для управления сущьностью
```
class EntityRepository
{
    //достаем один елемент сущьности по id, если нет
    //бросаем исключение
    public function get($id): Entity
    {
        if (!$entity = Entity::findOne($id)) {
            throw new NotFoundException('Entity is not found');
        }
        return $entity;
    }
    
    //Сохраняем сущьность в базу из принятого обьекта
    //если не получилось бросаем исключение
    public function save(Entity $entity): void
    {
        if (!$entity->save()) {
            throw new \RuntimeException('Saving error');
        }
    }

    //Удаляем сущьность из базы приняв обьект сущьности
    //если не получилось бросаем исключение
    public function remove(Entity $entity): void
    {
        if (!$entity->delete()) {
            throw new \RuntimeException('Removing Error');
        }
    }
}
```
