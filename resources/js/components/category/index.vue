<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-item-center">
                    <h5 class='mb-0'>
                        Product Category
                    </h5>

                    <router-link class="btn btn-primary btn-sm" :to="{name:'category-create'}">+</router-link>
                    </div>

                    <div class="card-body">
                        <table class="table table-light table-hover table-sm">
                            <thead class="thead bg-danger">
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Slug</th>
                                    <th class='text-center'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for ="(category,index) in categories" :key="index">
                                    <td>{{index+1}}</td>
                                    <td>{{category.name}}</td>
                                    <td>{{category.slug}}</td>
                                    <td class="text-center">
                                       <router-link :to="{name:'category-edit',params:{id:category.id}}" class="btn btn-primary btn-sm"  role="button">Edit</router-link>
                                       <a @click.prevent = "deleteCategory(category)" class="btn btn-danger btn-sm" href="#" role="button">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories:[]
            }
        },
        methods: {
            loadCategories(){
                axios.get('/api/category').then(response => {
                    this.categories = response.data.categories            
                });
            },

            deleteCategory(category){
               alertify.confirm('<i>are you sure to delete this category?</i>', '<i>please confirm us to delete this!</i>', function(){ 
                    axios.delete(`/api/category/${category.id}`).then(response => {
                        if(response.data == 'success'){

                            this.categories = this.categories.filter( data => {
                                return data.id != category.id;
                            });

                            alertify.success('<i>deleted successfully!</i>');
                           
                        }else{
                            alertify.error('<i>something went wrong!</i>');
                        }   
                    });
                   },
                 function(){ 
                    
                    alertify.error('<i>cancel</i>')
                    
                });
            }
        },
        mounted() {
            this.loadCategories();
            console.log('Component mounted.');
        }
    }
</script>
