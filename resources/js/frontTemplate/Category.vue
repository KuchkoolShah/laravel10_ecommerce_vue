<template>
    <Layout>
        <!-- slider-area -->
        <template v-slot:content>

            <!-- breadcrumb-area -->
            <section class="breadcrumb-area breadcrumb-bg"
                data-background="url(http://127.0.0.1:8000/asset/img/bg/breadcrumb_bg01.jpg)"
                style="background-image: url(http://127.0.0.1:8000/asset/img/bg/breadcrumb_bg01.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb-content">
                                <h2>Shop Sidebar</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Shop</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb-area-end -->

            <!-- shop-area -->
            <section class="shop-area pt-100 pb-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-9 col-lg-8">
                            <div class="shop-top-meta mb-35">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="shop-top-left">
                                            <ul>
                                                <li><a href="#"><i class="flaticon-menu"></i> FILTER</a></li>
                                                <li>Showing 1–9 of 80 results</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="shop-top-right">
                                            <form action="#">
                                                <select name="select">
                                                    <option value="">Sort by newness</option>
                                                    <option>Free Shipping</option>
                                                    <option>Best Match</option>
                                                    <option>Newest Item</option>
                                                    <option>Size A - Z</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div v-for="item in products" :key="item.id" class="col-xl-4 col-sm-6">
                                    <div class="new-arrival-item text-center mb-50">
                                        <div class="thumb mb-25">
                                            <a href="shop-details.html"><img :src=item.image alt=""></a>
                                            <div class="product-overlay-action">
                                                <ul>
                                                    <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                                                    <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <h5><a href="shop-details.html">{{ item . name }}</a></h5>
                                            <span class="price">${{ item . product_attributes[0] . price }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pagination-wrap">
                                <ul>
                                    <li class="prev"><a href="#">Prev</a></li>
                                    <li><a href="#">1</a></li>
                                    <li class="active"><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">...</a></li>
                                    <li><a href="#">10</a></li>
                                    <li class="next"><a href="#">Next</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4">
                            <aside class="shop-sidebar">
                                <div class="widget side-search-bar">
                                    <form action="#">
                                        <input type="text">
                                        <button><i class="flaticon-search"></i></button>
                                    </form>
                                </div>
                                <div class="widget">
                                    <h4 class="widget-title">Product Categories</h4>
                                    <div class="shop-cat-list">
                                        <ul>
                                            <li v-for="item in categories" :key="item.id">
                                                <router-link
                                                    :to="'/category/' + item.slug">{{ item . name }}</router-link>
                                                <span>(6)</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="widget">
                                    <h4 class="widget-title">Price Filter</h4>
                                    <div class="price_filter">
                                        <div id="slider-range"
                                            class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                            <div class="ui-slider-range ui-widget-header ui-corner-all"
                                                style="left: 12.1212%; width: 68.1818%;"></div><span
                                                class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"
                                                style="left: 12.1212%;"></span><span
                                                class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"
                                                style="left: 80.303%;"></span>
                                        </div>
                                        <div class="price_slider_amount">
                                            <span>Price :</span>
                                            <input type="text" id="amount" name="price" v-model="priceRangge"
                                                placeholder="Add Your Price">
                                        </div>
                                    </div>
                                </div>
                                <div  v-for="item in attributes" :key="item.id" class="widget">
                                    <h4 class="widget-title">{{ item.attribute.name }}</h4>
                                    <div class="sidebar-brand-list">
                                        <ul>
                                            <li v-for="attrItem in item.attribute.value" :key="attrItem.id"  v-on:click="addDataAttr('attribute',item.id)"><a
                                                 href="javascript:void(0)">{{ attrItem.name }} <i
                                                        class="fas fa-angle-double-right"></i></a></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="widget">
                                    <h4 class="widget-title">Product Brand</h4>
                                    <div class="sidebar-brand-list">
                                        <ul>
                                            <li v-for="item in brands" :key="item.id" v-on:click="addDataAttr('brand',item.id)"><a
                                                 href="javascript:void(0)">{{ item . text }} <i
                                                        class="fas fa-angle-double-right"></i></a></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="widget has-border">
                                    <div class="sidebar-product-size mb-30">
                                        <h4 class="widget-title">Product Size</h4>
                                        <div class="shop-size-list">
                                            <ul>
                                                <li v-for="item in sizes" :key="item.id" v-on:click="addDataAttr('size',item.id)"><a
                                                        href="javascript:void(0)">{{ item . text }}</a></li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="sidebar-product-color">
                                        <h4 class="widget-title">Color</h4>
                                        <div class="shop-color-list">
                                            <ul>
                                                <li v-for="item in colors" :key="item.id"
                                                    :style="{ backgroundColor: item.value }" v-on:click="addDataAttr('color',item.id)"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="cart-coupon">
                                        <form action="#">
                                            <input type="text" placeholder="Enter Coupon Code...">
                                            <button class="btn">Filter</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="widget">
                                    <h4 class="widget-title">Top Items</h4>
                                    <div class="sidebar-product-list">
                                        <ul>
                                            <li>
                                                <div class="sidebar-product-thumb">
                                                    <a href="#"><img src="img/product/sidebar_product01.jpg"
                                                            alt=""></a>
                                                </div>
                                                <div class="sidebar-product-content">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <h5><a href="#">Woman T-shirt</a></h5>
                                                    <span>$ 39.00</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="sidebar-product-thumb">
                                                    <a href="#"><img src="img/product/sidebar_product02.jpg"
                                                            alt=""></a>
                                                </div>
                                                <div class="sidebar-product-content">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <h5><a href="#">Slim Fit Cotton</a></h5>
                                                    <span>$ 39.00</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="sidebar-product-thumb">
                                                    <a href="#"><img src="img/product/sidebar_product03.jpg"
                                                            alt=""></a>
                                                </div>
                                                <div class="sidebar-product-content">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <h5><a href="#">Fashion T-shirt</a></h5>
                                                    <span>$ 39.00</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
                <input type="hidden"   @keypress="isNumber($event)" v-model="highPrice" ref="highPrice" id="highPrice" />
                <input type="hidden"   @keypress="isNumber($event)" v-model="lowPrice" ref="lowPrice" id="lowPrice" />

                <p>High Price: {{ highPrice }}</p>
                <p>Low Price: {{ lowPrice }}</p>

            </section>
            <!-- shop-area-end -->


        </template>
    </Layout>
    <!-- instagram-post-area-end -->
</template>

<script>
    import {
        ref,
        onMounted
    } from "vue";
    import {
        useRoute
    } from "vue-router";
    import Layout from './Layouts.vue';
    import axios from 'axios';
    import getUrlList from '../provider.js'

    export default {
        name: "Category",
        components: {
            Layout
        },
        data() {
            return {
                categories: [],
                products: [],
                brands: [],
                colors: [],
                sizes: [],
                attributes:[],
                attribute:[],
                caterory: '',
                lowPrice: '',
                highPrice: '',
                priceRangge: '',
                brand: [],
                color: [],
                size: [],
                brandColor:'brandColor'
            }
        },
        mounted() {
            this.getProducts();
        },
        watch: {
            '$route'() {
                this.getProducts();
            }
        },
        methods: {
            isNumber(evt){
            const charcode = evt.which ? evt.which :evt.keyCode;
            if(charcode >31 && (charcode <48 ||charcode <57) &&  charcode !==46 ){
              evt.preventDefault();
            }
            },
            addDataAttr(type, value) {
                console.log(type, value);
                if ($type == 'color') {
                  if(this.checkedArray(type, value)){
                    this.color.splice(this.color.indexOf(value),1);
                  }else{
                    this.color.push(value);
                  }
                } else if ($type == 'brand') {
                    if(this.checkedArray(type, value)){
                    this.brand.splice(this.brand.indexOf(value),1);
                  }else{
                    this.brand.push(value);
                  }
                } else if ($type == 'size') {
                    if(this.checkedArray(type, value)){
                    this.size.splice(this.brand.indexOf(value),1);
                  }else{
                    this.size.push(value);
                  }
                } else if ($type == 'attribute') {
                    if(this.checkedArray(type, value)){
                    this.attribute.splice(this.brand.indexOf(value),1);
                  }else{
                    this.attribute.push(value);
                  }
                }

            },
            checkedArray(type, value) {
                if ($type == 'color') {
                  return this.color.includes(value);
                } else if ($type == 'brand') {
                    return this.brand.includes(value);
                } else if ($type == 'size') {
                    return this.size.includes(value);
                }else if ($type == 'attribute') {
                    return this.attribute.includes(value);
                }
            },
            async getProducts() {
                const route = useRoute();
                this.slug = this.$route.params.slug; //'electronics';     //

                try {
                    if (this.slug == '' || this.slug == undefined || this.slug == null) {
                        //this.$router.push({name:'Index'});
                    } else {

                        let data = await axios.get(getUrlList().getCategoryData + '/' + this.slug);

                        if (data.status == 200 && data.data.data.data.products.data.length > 0) {
                            console.log(data.data.data.data);
                            this.categories = data.data.data.data.categories,
                                this.products = data.data.data.data.products.data,
                                this.brands = data.data.data.data.brands,
                                this.colors = data.data.data.data.color,
                                this.sizes = data.data.data.data.size,
                                this.attributes = data.data.data.data.attributes,
                                this.highPrice = data.data.data.data.highPrice,
                                this.lowPrice = data.data.data.data.lowPrice

                        } else {

                        }

                    }

                } catch (error) {

                }
            }
        }

    }
</script>
<style>
.brandColor::before{
    background-color: #ee1d1d;
}
</style>
