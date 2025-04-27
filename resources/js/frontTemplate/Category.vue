<template>
    <Layout>
      <template v-slot:content>

        <!-- breadcrumb-area -->
        <!-- [your breadcrumb section here] -->

        <!-- shop-area -->
        <section class="shop-area pt-100 pb-100">
          <div class="container">
            <div class="row">
              <!-- Products Section -->
              <div class="col-xl-9 col-lg-8">
                <div class="shop-top-meta mb-35">
                  <!-- [Filter Bar Top] -->
                </div>

                <div class="row">
                  <div v-for="item in products" :key="item.id" class="col-xl-4 col-sm-6">
                    <div class="new-arrival-item text-center mb-50">
                      <div class="thumb mb-25">
                        <a href="shop-details.html">
                          <img :src="item.image" alt="" />
                        </a>
                        <div class="product-overlay-action">
                          <ul>
                            <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                            <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="content">
                        <h5><a href="shop-details.html">{{ item.name }}</a></h5>
                        <span class="price">${{ item.product_attributes[0]?.price }}</span>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Pagination -->
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

              <!-- Sidebar -->
              <div class="col-xl-3 col-lg-4">
                <aside class="shop-sidebar">
                  <!-- [Search bar] -->
                  <!-- [Product Categories] -->
                  <!-- [Price Filter] -->

                  <!-- Attributes Filter -->
                  <div v-for="item in attributes" :key="item.id" class="widget">
                    <h4 class="widget-title">{{ item.attribute.name }}</h4>
                    <div class="sidebar-brand-list">
                      <ul>
                        <li v-for="attrItem in item.attribute.value" :key="attrItem.id" @click="addDataAttr('attribute', item.id)">
                          <a href="javascript:void(0)">
                            {{ attrItem.name }}
                            <i class="fas fa-angle-double-right"></i>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>

                  <!-- Brands Filter -->
                  <div class="widget">
                    <h4 class="widget-title">Product Brand</h4>
                    <div class="sidebar-brand-list">
                      <ul>
                        <li v-for="item in brands" :key="item.id" @click="addDataAttr('brand', item.id)">
                          <a href="javascript:void(0)">
                            {{ item.text }}
                            <i class="fas fa-angle-double-right"></i>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>

                  <!-- Sizes Filter -->
                  <div class="widget">
                    <h4 class="widget-title">Product Size</h4>
                    <div class="shop-size-list">
                      <ul>
                        <li v-for="item in sizes" :key="item.id" @click="addDataAttr('size', item.id)">
                          <a href="javascript:void(0)">{{ item.text }}</a>
                        </li>
                      </ul>
                    </div>
                  </div>

                  <!-- Colors Filter -->
                  <div class="widget">
                    <h4 class="widget-title">Color</h4>
                    <div class="shop-color-list">
                      <ul>
                        <li
                          v-for="item in colors"
                          :key="item.id"
                          :style="{ backgroundColor: item.value }"
                          @click="addDataAttr('color', item.id)"
                        ></li>
                      </ul>
                    </div>
                  </div>
                </aside>
              </div>
            </div>
          </div>

          <!-- Hidden Inputs -->
          <input type="hidden" @keypress="isNumber($event)" v-model="highPrice" />
          <input type="hidden" @keypress="isNumber($event)" v-model="lowPrice" />

          <p>High Price: {{ highPrice }}</p>
          <p>Low Price: {{ lowPrice }}</p>
        </section>

      </template>
    </Layout>
  </template>

  <script>
  import { useRoute } from "vue-router";
  import Layout from './Layouts.vue';
  import axios from 'axios';

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
        attributes: [],
        attribute: [],
        category: '',
        lowPrice: '',
        highPrice: '',
        priceRange: '',
        brand: [],
        color: [],
        size: [],
      };
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
      isNumber(evt) {
        const charCode = evt.which ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode !== 46) {
          evt.preventDefault();
        }
      },
      addDataAttr(type, value) {
        console.log("Clicked Filter:", type, value);

        if (type === 'color') {
          this.toggleFilter(this.color, value);
        } else if (type === 'brand') {
          this.toggleFilter(this.brand, value);
        } else if (type === 'size') {
          this.toggleFilter(this.size, value);
        } else if (type === 'attribute') {
          this.toggleFilter(this.attribute, value);
        }
      },
      toggleFilter(array, value) {
        const index = array.indexOf(value);
        if (index !== -1) {
          array.splice(index, 1);
        } else {
          array.push(value);
        }
        console.log('Current Filters:', { color: this.color, brand: this.brand, size: this.size, attribute: this.attribute });
      },
      async getProducts() {
        try {
          const route = useRoute();
          const slug = route.params.slug || 'mobile'; // fallback

          let response = await axios.get(`http://127.0.0.1:8000/api/getCategoryData/${slug}`);

          if (response.status === 200) {
            const data = response.data.data.data;

            this.categories = data.categories;
            this.products = data.products.data;
            this.brands = data.brands;
            this.colors = data.color;
            this.sizes = data.size;
            this.attributes = data.attributes;
            this.highPrice = data.highPrice;
            this.lowPrice = data.lowPrice;

            console.log('Fetched Products:', this.products);
          } else {
            console.error('No data found!');
          }
        } catch (error) {
          console.error('Error fetching products:', error);
        }
      }
    }
  };
  </script>

  <style scoped>
  .brandColor::before {
    background-color: #ee1d1d;
  }
  </style>
