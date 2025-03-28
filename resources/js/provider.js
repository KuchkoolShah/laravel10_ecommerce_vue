export function getUrlList(){
    const baseUrl = "http://127.0.0.1:8000/api";
    return {
        getHeadercategoriesData:''+baseUrl+'/getHeadercategoriesData',
        getHomeData:''+baseUrl+'/getHomeData',
        getCategoryData:''+baseUrl+'/getCategoryData',
        getUserData:''+baseUrl+'/getUserData',
        getCartData:''+baseUrl+'/getCartData',
        addToCart:''+baseUrl+'/addToCart',





    }
}

export default getUrlList;
