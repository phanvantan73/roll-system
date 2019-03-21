<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <button @click="initAddProduct()" class="btn btn-success " style="padding:5px">
                    Add New Product
                </button>
                <br>
                <table class="table table-success">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(product, index) in products">
                            <th>{{ index + 1 }}</th>
                            <th>{{ product.name }}</th>
                            <th>{{ product.price }}</th>
                            <th>
                                <button class="btn btn-info" @click="initUpdate(index)">Edit</button><button class="btn btn-danger" @click="deleteProduct(index)">Delete</button>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="add_product_model">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h4 class="modal-title">Add New Product</h4>
                   </div>
                   <div class="modal-body">
                       <div class="alert alert-danger" v-if="errors.length > 0">
                           <ul>
                               <li v-for="error in errors">{{ error }}</li>
                           </ul>
                       </div>
                       <div class="form-group">
                           <label for="name">Name:</label>
                           <input type="text" name="name" id="name" placeholder="Product Name" class="form-control" v-model="product.name">
                       </div>
                       <div class="form-group">
                           <label for="price">Price:</label>
                           <input type="text" name="price" id="price" class="form-control" placeholder="Product Price" v-model="product.price"></input>
                       </div>
                   </div>
                   <div class="modal-footer">
                        <button type="button" @click="createProduct" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                   </div>
               </div><!-- /.modal-content -->
           </div><!-- /.modal-dialog -->
       </div>
       <div class="modal fade" tabindex="-1" role="dialog" id="update_product_model">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                        <h4 class="modal-title">Update Product</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                   </div>
                   <div class="modal-body">
                       <div class="alert alert-danger" v-if="errors.length > 0">
                           <ul>
                               <li v-for="error in errors">{{ error }}</li>
                           </ul>
                       </div>
                       <div class="form-group">
                           <label>Name:</label>
                           <input type="text" placeholder="Product Name" class="form-control" v-model="update_product.name">
                       </div>
                       <div class="form-group">
                           <label for="price">Price:</label>
                           <input type="text" class="form-control" placeholder="Product Price" v-model="update_product.price"></input>
                       </div>
                   </div>
                   <div class="modal-footer">
                       <button type="button" @click="updateProduct" class="btn btn-primary">Update</button>
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                   </div>
               </div><!-- /.modal-content -->
           </div><!-- /.modal-dialog -->
       </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                product: {
                    name: '',
                    price: ''
                },
                products: [],
                errors: [],
                update_product: {}
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.readProducts();
        },
        methods: {
            readProducts() {
                axios.get('/product')
                    .then(response => {
                        this.products = response.data.products;
                    });
            },
            initAddProduct() {
                $('#add_product_model').modal('show');
            },
            createProduct() {
                axios.post('/product', {
                    name: this.product.name,
                    price: this.product.price
                })
                    .then(response => {
                        this.reset();
                        this.products.push(response.data.product);
                        $('#add_product_model').modal('hide');
                    })
                    .catch(error => {
                        this.errors = [];
                        if (error.response.data.errors && error.response.data.errors.name) {
                            this.errors.push(error.response.data.errors.name[0]);
                        }
                        if (error.response.data.errors &&  error.response.data.errors.price) {
                            this.errors.push(error.response.data.errors.price[0]);
                        }
                    });
            },
            reset() {
                this.product.name = '';
                this.product.price = '';
            },
            initUpdate(index) {
                this.errors = [];
                $('#update_product_model').modal('show');
                this.update_product = this.products[index];
            },
            updateProduct() {
                axios.patch('/product/' + this.update_product.id, {
                    name: this.update_product.name,
                    price: this.update_product.price
                })
                    .then(response => {
                        $('#update_product_model').modal('hide');
                    })
                    .catch(error => {
                        this.errors = [];
                        if (error.response.data.errors.name) {
                            this.errors.push(error.response.data.errors.name[0]);
                        }
                        if (error.response.data.errors.price) {
                            this.errors.push(error.response.data.errors.price[0]);
                        }
                    });
            },
            deleteProduct(index) {
                let conf = confirm('Are you really want to delete this product?');
                if (conf === true) {
                    axios.delete('/product/' + this.products[index].id)
                        .then(response => {
                            this.products.splice(index, 1);
                        })
                        .catch(error => {
                        })
                }
            }
        }
    }
</script>
