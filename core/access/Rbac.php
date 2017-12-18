<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.09.17
 * Time: 13:40
 */


namespace core\access;

class Rbac
{
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';
    const ROLE_MANAGER = 'manager';
    const PERMISSION_ROLE_EDIT = 'permRoleEdit';
    const PERMISSION_ROLE_VIEW = 'permRoleView';
    const PERMISSION_USER_VIEW = 'permUserView';
    const PERMISSION_USER_EDIT = 'permUserEdit';
    const PERMISSION_PAGE_EDIT = 'permPageEdit';
    const PERMISSION_PAGE_VIEW = 'permPageView';
    const PERMISSION_FILE_VIEW = 'permFileView';
    const PERMISSION_DELIVERY_VIEW = 'permDeliveryView';
    const PERMISSION_DELIVERY_EDIT = 'permDeliveryEdit';
    const PERMISSION_SHOP_BRAND_VIEW = 'permShopBrandView';
    const PERMISSION_SHOP_BRAND_EDIT = 'permShopBrandEdit';
    const PERMISSION_SHOP_CATEGORY_VIEW = 'permShopCategoryView';
    const PERMISSION_SHOP_CATEGORY_EDIT = 'permShopCategoryEdit';
    const PERMISSION_SHOP_CHARACTERISTIC_VIEW = 'permShopCharacteristicView';
    const PERMISSION_SHOP_CHARACTERISTIC_EDIT = 'permShopCharacteristicEdit';
    const PERMISSION_SHOP_MODIFICATION_VIEW = 'permShopModificationView';
    const PERMISSION_SHOP_MODIFICATION_EDIT = 'permShopModificationEdit';
    const PERMISSION_SHOP_WAREHOUSES_PRODUCT_VIEW = 'permShopWarehousesProductView';
    const PERMISSION_SHOP_WAREHOUSES_PRODUCT_EDIT = 'permShopWarehousesProductEdit';
    const PERMISSION_SHOP_ORDER_VIEW = 'permShopOrderView';
    const PERMISSION_SHOP_ORDER_EDIT = 'permShopOrderEdit';
    const PERMISSION_SHOP_PRODUCT_VIEW = 'permShopProductView';
    const PERMISSION_SHOP_PRODUCT_EDIT = 'permShopProductEdit';
    const PERMISSION_SHOP_TAG_VIEW = 'permShopTagView';
    const PERMISSION_SHOP_TAG_EDIT = 'permShopTagEdit';
    const PERMISSION_SHOP_WAREHOUSE_EDIT = 'permShopWarehouseEdit';
    const PERMISSION_SHOP_WAREHOUSE_VIEW = 'permShopWarehouseView';
    const PERMISSION_SHOP_STORE_EDIT = 'permShopStoreEdit';
    const PERMISSION_SHOP_STORE_VIEW = 'permShopStoreView';
    const PERMISSION_SHOP_GIVE_POINT_EDIT = 'permShopGivePointEdit';
    const PERMISSION_SHOP_GIVE_POINT_VIEW = 'permShopGivePointView';
    const PERMISSION_BLOG_CATEGORY_VIEW = 'permBlogCategoryView';
    const PERMISSION_BLOG_CATEGORY_EDIT = 'permBlogCategoryEdit';
    const PERMISSION_BLOG_COMMENT_VIEW = 'permBlogCommentView';
    const PERMISSION_BLOG_COMMENT_EDIT = 'permBlogCommentEdit';
    const PERMISSION_BLOG_POST_VIEW = 'permBlogPostView';
    const PERMISSION_BLOG_POST_EDIT = 'permBlogPostEdit';
    const PERMISSION_BLOG_TAG_VIEW = 'permBlogTagView';
    const PERMISSION_BLOG_TAG_EDIT = 'permBlogTagEdit';
    const PERMISSION_PRODUCT_REVIEW_VIEW = 'permProductReviewView';
    const PERMISSION_PRODUCT_REVIEW_EDIT = 'permProductReviewEdit';
}