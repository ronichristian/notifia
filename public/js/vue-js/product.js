

new Vue({
    el: '#share_products_in_the_week',

    data: {
        products: [],
        
        id: '',
		e_id: '',
		p_product_name: '',
		p_product_qty: '',    
		p_product_price: '',
		
		newItem: { 'product_name': '','product_qty': '','product_price': '' },
    },
   
    mounted() {
        this.getProducts();
    },

    methods: {
        getProducts: function getProducts(){
            var _this = this;

            axios.get('/get_products').then(function (response) {
                _this.products = response.data;
            });
        },

        // createItem: function createItem() {
		// 	var _this = this;
		// 	var input = this.newItem;

		// 	axios.post('/add_products', input).then(function (response) {
		// 		_this.newItem = { 'product_name': '', 'product_qty': '', 'product_price': '' };
		// 		_this.getProducts();

		// 		toastr.success('Added successfully.');
		// 	}).catch(error => {
		// 		toastr.error('Fill all fields!');
		// 	});
        // },
        
        // setVal(prod_id, prod_name, prod_qty, prod_price) {
		// 	this.p_id = prod_id;
		// 	this.p_product_name = prod_name;
		// 	this.p_product_qty = prod_qty;
		// 	this.p_product_price = prod_price;
        // },
        
        // editProduct: function(){		
		// 	var product_name = document.getElementById('p_product_name');
		// 	var product_qty = document.getElementById('p_product_qty');
		// 	var product_price = document.getElementById('p_product_price');

		// 	axios.post('/update_product/' + this.p_id, {p_product_name: product_name.value, p_product_qty: product_qty.value, p_product_price: product_price.value })
		// 	.then(response => {
		// 		this.getProducts();

		// 		$('#'+this.p_id).modal('hide');
		// 		$('.modal-backdrop').remove();
		// 		toastr.success('Updated successfully.');			
		// 	});

		// },

        // deleteItem: function deleteItem(product) {
		// 	var _this = this;
		// 	axios.post('/delete_product/' + product.id).then(function (response) {
		// 		_this.getProducts();

		// 		toastr.success('Deleted successfully.');
		// 	});
		// }

    },
})