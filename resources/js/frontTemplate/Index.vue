<template>
    <Layout>
          <!-- slider-area -->
           <template v-slot:content>
          <section class="slider-area position-relative">
                <div class="third-slider-active">
                    <div   v-for="item in homeBanner" :key="item.id" class="third-slider-item third-slider-bg" style="background-image: url('/front_assets/img/slider/third_slider_bg.jpg');" >
                        <div class="container custom-container-two">
                            <div class="third-slider-wrap">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="slider-content">
                                            <h3 class="sub-title" data-animation-in="fadeInUp" data-delay-in=".2" data-duration-in="1.5">best offer !</h3>
                                            <h2 class="title" data-animation-in="fadeInUp" data-delay-in=".4" data-duration-in="1.5">{{ item.text }}</h2>
                                            <p data-animation-in="fadeInUp" data-delay-in=".6" data-duration-in="1.5">Get up to 50% off Today Only</p>
                                            <a href="shop-sidebar.html" class="btn" data-animation-in="fadeInUp" data-delay-in=".8" data-duration-in="1.5">Shop now</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="third-slider-img">
                                            <div class="img-shape" style="background-image: url('/front_assets/img/slider/third_slide_shape.png');" data-animation-in="zoomIn"
                                                data-delay-in="1" data-duration-in="1.5"></div>
                                            <img :src="item.image" alt="" class="main-img" data-animation-in="slideInRight2"
                                                data-delay-in="1" data-duration-in="1.5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- slider-area-end -->

            <!-- shoes-category-area -->
            <div class="shoes-category-area pt-80 pb-30">
                <div class="container custom-container-two">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 col-sm-9" v-for="item in getShortArray(3)" :key="item.id">
                            <div class="shoes-cat-item mb-50" >
                                <div class="thumb mb-30">
                                    <a href="shop-sidebar.html"><img :src="item.image" alt=""></a>
                                </div>
                                <div class="content">
                                    <ul>
                                        <li><a href="shop-sidebar.html">{{item.name}}</a></li>
                                        <li><span>18</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- shoes-category-area-end -->

            <!-- trending-product-area -->
            <section class="trending-product-area trending-product-two gray-bg pt-95 pb-100">
                <div class="container custom-container">
                    <div class="row justify-content-center">
                        <div class="col-xl-4 col-lg-6">
                            <div class="section-title title-style-two text-center mb-50">
                                <h3 class="title">Trending Products</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row no-gutters trending-product-grid">
                        <div class="col-2">
                            <div class="trending-products-list">
                                <h5>Category Shoes</h5>
                                <ul class="nav nav-tabs" id="trendingTab" role="tablist">
                                    <li class="nav-item" role="presentation"  v-for="(catItem ,index) in getShortArray(6)" :key="catItem.id">
                                        <a  :class="'nav-link '+ showActiveClass(1,index)" :id="'cat'+catItem.id" data-toggle="tab" :href="'#cat-tab'+catItem.id" role="tab" :aria-controls="'cat'+catItem.id" aria-selected="true">{{ catItem.name }}</a>

                                    </li>

                                </ul>

                            </div>
                        </div>
                        <div class="col-10">
                            <div class="tab-content tp-tab-content" id="trendingTabContent">
                                <div :class="'tab-pane '+ showActiveClass(1,index)" v-for="(catItem ,index) in getShortArray(6)" :key="catItem.id"
                                :id="'cat-tab'+catItem.id" role="tabpanel" aria-labelledby="accessories-tab">
                                    <div class="trending-products-banner banner-animation">
                                        <a href="shop-sidebar.html"><img src="./../asset/img/images/trending_banner03.jpg" alt=""></a>
                                    </div>
                                    <div class="row trending-product-active" v-if="catItem.products.length > 0">
                                        <div class="col" v-for="item in catItem.products" :key="item.id">
                                            <div class="features-product-item">
                                                <div class="features-product-thumb">
                                                    <div class="discount-tag">-20%  not chked</div>
                                                    <a href="shop-details.html">
                                                        <img :src="item.image" alt="">
                                                    </a>
                                                    <div class="product-overlay-action">
                                                        <ul>
                                                            <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                                                            <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="features-product-content">
                                                    <div class="rating">
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                    </div>
                                                    <h5><a href="shop-details.html">{{item.name}}</a></h5>
                                                    <p class="price">{{item.item_code}}</p>
                                                    <div class="features-product-bottom">
                                                        <ul>
                                                            <li class="color-option">
                                                                <span class="gray"></span>
                                                                <span class="cyan"></span>
                                                                <span class="orange"></span>
                                                            </li>
                                                            <li class="limited-time"><a href="#">Limited-Time Offer!</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="features-product-cart"><a href="cart.html">add to cart</a></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- trending-product-area-end -->

            <!-- new-arrival-area -->
            <section class="new-arrival-area pt-95 pb-45">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-4 col-lg-6">
                            <div class="section-title title-style-two text-center mb-45">
                                <h3 class="title">New Arrival Collection</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="new-arrival-nav mb-35">
                                <button :class="+ showActiveClass(1,index)" :data-filter="'cat-'+catItem.id" v-for="(catItem ,index) in getShortArray(6)" :key="catItem.id" >{{catItem.name}}</button>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div v-for="item in homeproducts"  :class="'col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-'+item.category_id">
                            <div class="new-arrival-item text-center mb-50">
                                <div class="thumb mb-25">
                                    <a href="shop-details.html"><img :src="item.image" ></a>
                                    <div class="product-overlay-action">
                                        <ul>
                                            <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                                            <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="content">
                                    <h5><a href="shop-details.html">{{ item.name }}</a></h5>
                                    <span class="price">$37.00</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!-- new-arrival-area-end -->

            <!-- shoes-banner-area -->
            <section class="shoes-banner-area">
                <div class="container">
                    <div class="shoes-banner-active">
                        <div class="shoes-banner-bg" style="background-image: url('/front_assets/img/bg/shoes-banner_bg.jpg');">
                            <div class="row">
                                <div class="col-12">
                                    <div class="shoes-banner-content">
                                        <h6>Athletes Shoes</h6>
                                        <h2>9 Best <span>Shoes for</span> Standing All Day Review 2020</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shoes-banner-bg" style="background-image: url('/front_assets/img/bg/shoes-banner_bg.jpg');">
                            <div class="row">
                                <div class="col-12">
                                    <div class="shoes-banner-content">
                                        <h6>Athletes Shoes</h6>
                                        <h2>3 Best <span>Shoes for</span> Standing All Day Review 2021</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shoes-banner-bg" style="background-image: url('/front_assets/img/bg/shoes-banner_bg.jpg');">
                            <div class="row">
                                <div class="col-12">
                                    <div class="shoes-banner-content">
                                        <h6>Athletes Shoes</h6>
                                        <h2>8 Best <span>Shoes for</span> Standing All Day Review 2021</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- shoes-banner-area-end -->

            <!-- promo-services -->
            <section class="promo-services pt-70 pb-25">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-md-6 col-sm-8">
                            <div class="promo-services-item mb-40">
                                <div class="icon"><img src="./../asset/img/icon/promo_icon01.png" alt=""></div>
                                <div class="content">
                                    <h6>payment & delivery</h6>
                                    <p>Delivered, when you receive arrives</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-8">
                            <div class="promo-services-item mb-40">
                                <div class="icon"><img src="./../asset/img/icon/promo_icon02.png" alt=""></div>
                                <div class="content">
                                    <h6>Return Product</h6>
                                    <p>Retail, a Product Return Process</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-8">
                            <div class="promo-services-item mb-40">
                                <div class="icon"><img src="./../asset/img/icon/promo_icon03.png" alt=""></div>
                                <div class="content">
                                    <h6>money back guarantee</h6>
                                    <p>Options Including 24/7</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-8">
                            <div class="promo-services-item mb-40">
                                <div class="icon"><img src="./../asset/img/icon/promo_icon04.png" alt=""></div>
                                <div class="content">
                                    <h6>Quality support</h6>
                                    <p>Support Options Including 24/7</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- promo-services-end -->

            <!-- instagram-post-area -->
            <div class="instagram-post-area">
                <div class="container-fluid p-0 fix">
                    <div class="row no-gutters insta-active">
                        <div class="col">
                            <div class="insta-post-item">
                                <a href="#">
                                    <i class="fab fa-instagram"></i>
                                    <img src="./../asset/img/instagram/s_insta_post01.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="insta-post-item">
                                <a href="#">
                                    <i class="fab fa-instagram"></i>
                                    <img src="./../asset/img/instagram/s_insta_post02.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="insta-post-item">
                                <a href="#">
                                    <i class="fab fa-instagram"></i>
                                    <img src="./../asset/img/instagram/s_insta_post03.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="insta-post-item">
                                <a href="#">
                                    <i class="fab fa-instagram"></i>
                                    <img src="./../asset/img/instagram/s_insta_post04.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="insta-post-item">
                                <a href="#">
                                    <i class="fab fa-instagram"></i>
                                    <img src="./../asset/img/instagram/s_insta_post05.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="insta-post-item">
                                <a href="#">
                                    <i class="fab fa-instagram"></i>
                                    <img src="./../asset/img/instagram/s_insta_post03.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="insta-post-item kjhkj">
                                <a href="#">
                                    <i class="fab fa-instagram"></i>
                                    <img src="./../asset/img/instagram/s_insta_post04.jpg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        </Layout>
            <!-- instagram-post-area-end -->
</template>
<script>
import Layout from './Layouts.vue';
import axios from 'axios';
import getUrlList from '../provider.js';
export default{
    name:"Index",
    components:{
Layout
    },
    data(){
return {
homeBanner:[],
homeCategory:[],
homebrands:[],
homeproducts:[],
}
},
    mounted(){
        console.log("hii");
        this.getHomeData();
    },
    methods:{
        getShortArray(size){
        return this.homeCategory.slice(0,size);
        },
        showActiveClass(type , index){
            if(type==1 && index==0){
             return 'active';
            }else if(type==2 && index==1){
             return 'show active';
            }else{
                return '';
            }

        },
    async getHomeData(){
            try{
             let data = await axios.get(getUrlList().getHomeData);
             if(data.status==200 && data.data.data.data.banner.length >0){
                console.log(data.data);
                this.homeCategory = data.data.data.data.categories,
                this.homeBanner = data.data.data.data.banner,
                this.homeBrands = data.data.data.data.brands,
                this.homeproducts=data.data.data.data.products


             }else{

             }
            }catch(error){

            }
        }
    }

}
</script>
