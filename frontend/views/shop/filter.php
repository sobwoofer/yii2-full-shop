<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 01.09.17
 * Time: 11:57
 */
?>

<div class="col-sm-3">
    <div class="wrpper_filterToggler  hidden-sm hidden-md hidden-lg">
        <h2 class="catalog-title"><b>Шариковые ручки</b></h2>
        <button id="showFilter" class="btn btn_blue btn_show_filter">Показать фильтр</button>
    </div>
    <div class="catalog-filter">
        <div class="gray">
            <p class="filter-title pull-left"><span class="icon"><img src="images/system/yes-icon.png" alt=""></span>ВЫБРАНО</p>
            <a href="#/" class="filter-title pull-right">
                <small><span class="icon"><img src="images/system/trash.png" alt=""></span>сбросить</small>
            </a>
            <div class="clearfix"></div>
            <a href="#" class="fiter-select-item">Economix </a>
            <a href="#" class="fiter-select-item">Economix </a>
            <a href="#" class="fiter-select-item">Economix </a>
        </div>
        <div class="gray">
            <p class="filter-title"><span class="icon"><img src="images/system/filter-icon.png" alt=""></span>ФИЛЬТР ХАРАКТЕРИСТИК</p>
            <p><b>Цена</b></p>
            <div class="manufacturer">
                <p>
                    <input type="text" id="minCost" value="0"/>
                    <span>&nbsp;-&nbsp;</span>
                    <input type="text" id="maxCost" value="1000"/>
                    <span> &nbsp;грн
                                <input type="submit" value="ok" class="ok"></span>
                    <span class="clearfix"></span>
                </p>
                <p><span class="pull-left">100грн</span><span class="pull-right">5000.00грн</span></p>

                <span class="clearfix" style="margin-top: 1px;"></span>

                <div id="slider-range"></div>
                <div class="filter_cat_wrp">

                    <p class="title"><b>Производитель </b> <span class="pull-right toggle-btn"></span></p>

                    <div class="filter_cat_block">
                        <label><input type="checkbox" value="1">Economix <span>(20)</span></label>
                        <label><input type="checkbox" value="1">Optima <span>(10)</span></label>
                        <label><input type="checkbox" value="1">Schneider <span>(7)</span></label>
                        <label><input type="checkbox" value="1">Parker <span>(5)</span></label>
                        <label><input type="checkbox" value="1">Waldmann <span>(3)</span></label>
                    </div>

                </div>

            </div>
            <hr>
            <div class="filter_cat_wrp active">
                <p class="title"><b>Наличие </b><span class="pull-right toggle-btn"></span></p>
                <div class="filter_cat_block">
                    <div class="Availability">

                        <label><input type="checkbox" value="1">Economix <span>(20)</span></label>
                        <label><input type="checkbox" value="1">Optima <span>(10)</span></label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="filter_cat_wrp active">
                <p class="title"><b>Толщина линий</b><span class="pull-right toggle-btn"></span></p>
                <div class="filter_cat_block">
                    <div class="line_thickness">
                        <label><input type="checkbox" value="1">Economix <span>(20)</span></label>
                        <label><input type="checkbox" value="1">Optima <span>(10)</span></label>
                        <label><input type="checkbox" value="1">Schneider <span>(7)</span></label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="filter_cat_wrp active">
                <p class="title"><b>Сменность стержня</b><span class="pull-right toggle-btn"></span></p>
                <div class="filter_cat_block">
                    <div class="replacement">
                        <label><input type="checkbox" value="1">Economix <span>(20)</span></label>
                        <label><input type="checkbox" value="1">Optima <span>(10)</span></label>
                        <label><input type="checkbox" value="1">Waldmann <span>(3)</span></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="responsive-img hidden-xs hidden-sm">
        <a href="#">
            <img src="images/b.png" alt="">
        </a>
    </div>
</div>
