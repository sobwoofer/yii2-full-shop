<?php

use yii\db\Migration;

class m170928_123858_add_user_permissions extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

        $this->batchInsert('{{%auth_items}}', ['type', 'name', 'description'], [
            [2, 'permBlogCategoryEdit', 'Blog Category Edit'],
            [2, 'permBlogCategoryView', 'Blog Category View'],
            [2, 'permBlogCommentEdit', 'Blog Comment Edit'],
            [2, 'permBlogCommentView', 'Blog Comment View'],
            [2, 'permBlogPostEdit', 'Blog Post Edit'],
            [2, 'permBlogPostView', 'Blog Post View'],
            [2, 'permBlogTagEdit', 'Blog Tag Edit'],
            [2, 'permBlogTagView', 'Blog Tag View'],
            [2, 'permDeliveryEdit', 'Delivery Edit'],
            [2, 'permDeliveryView', 'Delivery View'],
            [2, 'permFileView', 'File View'],
            [2, 'permPageEdit', 'Page Edit'],
            [2, 'permPageView', 'Page View'],
            [2, 'permRoleEdit', 'Role Edit'],
            [2, 'permRoleView', 'Role View'],
            [2, 'permShopBrandEdit', 'Shop Brand Edit'],
            [2, 'permShopBrandView', 'Shop Brand View'],
            [2, 'permShopCategoryEdit', 'Shop Category Edit'],
            [2, 'permShopCategoryView', 'Shop Category View'],
            [2, 'permShopCharacteristicEdit', 'Shop Characteristic Edit'],
            [2, 'permShopCharacteristicView', 'Shop Characteristic View'],
            [2, 'permShopModificationEdit', 'Shop Modification Edit'],
            [2, 'permShopModificationView', 'Shop Modification View'],
            [2, 'permShopOrderEdit', 'Shop Order Edit'],
            [2, 'permShopOrderView', 'Shop Order View'],
            [2, 'permShopProductEdit', 'Shop Prodict Edit'],
            [2, 'permShopProductView', 'Shop Product View'],
            [2, 'permShopTagEdit', 'Shop Tag Edit'],
            [2, 'permShopTagView', 'Shop Tag Edit'],
            [2, 'permUserEdit', 'User Edit'],
            [2, 'permUserView', 'User View'],
        ]);

        $this->batchInsert('{{%auth_item_children}}', ['parent', 'child'], [
            ['admin', 'permBlogCategoryEdit'],
            ['admin', 'permBlogCategoryView'],
            ['admin', 'permBlogCommentEdit'],
            ['admin', 'permBlogCommentView'],
            ['admin', 'permBlogPostEdit'],
            ['admin', 'permBlogPostView'],
            ['admin', 'permBlogTagEdit'],
            ['admin', 'permBlogTagView'],
            ['admin', 'permDeliveryEdit'],
            ['admin', 'permDeliveryView'],
            ['admin', 'permFileView'],
            ['admin', 'permPageEdit'],
            ['admin', 'permPageView'],
            ['admin', 'permRoleEdit'],
            ['admin', 'permRoleView'],
            ['admin', 'permShopBrandEdit'],
            ['admin', 'permShopBrandView'],
            ['admin', 'permShopCategoryEdit'],
            ['admin', 'permShopCategoryView'],
            ['admin', 'permShopCharacteristicEdit'],
            ['admin', 'permShopCharacteristicView'],
            ['admin', 'permShopModificationEdit'],
            ['admin', 'permShopModificationView'],
            ['admin', 'permShopOrderEdit'],
            ['admin', 'permShopOrderView'],
            ['admin', 'permShopProductEdit'],
            ['admin', 'permShopProductView'],
            ['admin', 'permShopTagEdit'],
            ['admin', 'permShopTagView'],
            ['admin', 'permUserEdit'],
            ['admin', 'permUserView'],
        ]);


    }

    public function down()
    {
        return false;
    }

}
