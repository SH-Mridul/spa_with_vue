<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create product category.</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 offset-3">
                                <form @submit.prevent ='createCategory' id="form">

                                    <div class="form-group">
                                        <label for="category">Name of category</label>
                                        <input type="text" v-model='name' class="form-control form-control-sm" id="category"  placeholder="enter valid category name.">
                                    </div>
                                   
                                    <button type="submit" class="btn btn-success btn-sm">Save Category</button>
                                    </form>
                            </div>
                        </div>
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
               name:'',
           }
       },

       methods: {
          createCategory(){

              if(this.name == ''){
                   alertify.error('<i>category field empty!</i>');
              }else{
                  axios.post('/api/category',{name:this.name}).then(response => {
                      if(typeof response.data.errors !== 'undefined'){
                          alertify.error('<i>'+response.data.errors.name[0]+'</i>');
                      }else{
                          this.name = '';
                          document.getElementById("form").reset();
                          alertify.success('<i>'+response.data+'</i>');
                      }

                  })
              }
          }
       },
    }
</script>
