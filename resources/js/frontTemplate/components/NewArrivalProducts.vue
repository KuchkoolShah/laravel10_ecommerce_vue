<template>
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
              <button
                v-for="(catItem, index) in getShortArray(6)"
                :key="catItem.id"
                :class="showActiveClass(1, index)"
                :data-filter="'cat-' + catItem.id"
              >
                {{ catItem.name }}
              </button>
            </div>
          </div>
        </div>

        <div class="row">
          <div
            v-for="item in homeproducts"
            :key="item.id"
            :class="'col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-' + item.category_id"
          >
            <div class="new-arrival-item text-center mb-50">
              <div class="thumb mb-25">
                <a href="shop-details.html">
                  <img :src="item.image" alt="Product Image" />
                </a>
                <div class="product-overlay-action">
                  <ul>
                    <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                    <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                  </ul>
                </div>
              </div>
              <div class="content">
                <h5>
                  <a href="shop-details.html">{{ item.name }}</a>
                </h5>
                <span class="price">$37.00</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </template>

  <script>
  export default {
    name: "NewArrivalProducts",
    props: {
      homeproducts: {
        type: Array,
        required: true,
      },
      showActiveClass: {
        type: Function,
        required: true,
      },
      getShortArray: {
        type: Function,
        required: true,
      },
    },
  };
  </script>

  <style scoped>
  /* Optional: Add your scoped styles here */
  </style>
