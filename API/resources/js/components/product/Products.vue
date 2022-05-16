<template>
  <section class="content">
    <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des produits</h3>

                <div class="card-tools">
                  
                  <button type="button" class="btn btn-sm btn-primary" @click="newModal">
                      <i class="fa fa-plus-square"></i>
                      Créer
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nom</th>
                      <th>Description</th>
                      <th>Categories</th>
                      <th>Prix</th>
                      <th>Date de mise en vente</th>
                      <th>Date de fin d'enchères</th>
                      <th>Vendeur</th>
                      <th>Etat de vente</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="product in products.data" :key="product.id">

                      <td>{{product.id}}</td>
                      <td>{{product.name}}</td>
                      <td>{{product.description | truncate(30, '...')}}</td>
                      <td><p v-for="cat in product.categories" :key="cat.id">{{cat.name}}</p></td>
                      <td>{{product.price}}</td>
                      <td>{{product.created_at}}</td>
                      <td>{{product.date_end}}</td>
                      <td>{{product.user_id}}</td>
                      <td>{{product.sold ? "vendu" : "en vente"}}</td>
                      <!-- <td><img v-bind:src="'/' + product.photo" width="100" alt="product"></td> -->
                      <td>
                        
                        <a href="#" @click="editModal(product)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteProduct(product.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="products" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode">Créer</h5>
                    <h5 class="modal-title" v-show="editmode">Mettre à jour</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form @submit.prevent="editmode ? updateProduct() : createProduct()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nom</label>
                            <input v-model="form.name" type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input v-model="form.description" type="text" name="description"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
                            <has-error :form="form" field="description"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Prix</label>
                            <input v-model="form.price" type="text" name="price"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('price') }">
                            <has-error :form="form" field="price"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Utilisateur</label>
                            <select class="form-control" v-model="form.user_id">
                              <option 
                                  v-for="user in users.data" :key="user.id"
                                  :value="user.id"
                                  :selected="user.id == form.user_id">{{ user.name }}</option>
                            </select>
                            <has-error :form="form" field="price"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Categories</label>
                            <select class="form-control" v-model="form.categories[0]">
                              <option 
                                  v-for="(cat,index) in categories" :key="index"
                                  :value="index"
                                  :selected="index == form.categories[0]">{{ cat }}</option>
                            </select>
                            <has-error :form="form" field="category_id"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Date de fin d'enchères</label>
                            <Datepicker :language="fr" v-model="form.end_date"/>
                            <has-error :form="form" field="end_date"></has-error>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button v-show="editmode" type="submit" class="btn btn-success">Mettre à jour</button>
                        <button v-show="!editmode" type="submit" class="btn btn-primary">Créer</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
  </section>
</template>

<script>
  import Datepicker from 'vuejs-datepicker';
  import moment from 'moment'
  export default {
    components: {
        Datepicker
      },
      data () {
          return {
              editmode: false,
              products : {},
              users : {},
              form: new Form({
                  id : '',
                  categories : [],
                  name: '',
                  description: '',
                  user_id: '',
                  photo: '',
                  price: '',
                  end_date: '',
                  sold: '',
                  photoUrl: '',
              }),
              categories: [],
            
          }
      },
      methods: {

        getResults(page = 1) {

            this.$Progress.start();
            
            axios.get('api/product?page=' + page).then(({ data }) => (this.products = data.data));

            this.$Progress.finish();
        },
        loadProducts(){

          // if(this.$gate.isAdmin()){
            axios.get("api/product").then(({ data }) => (this.products = data.data));
          // }
        },
        loadCategoriesAndUsers(){
            axios.get("/api/category/list").then(({ data }) => (this.categories = data.data));
            axios.get("/api/user").then(({ data }) => (this.users = data.data));
        },
        editModal(product){
            this.editmode = true;
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(product);
        },
        newModal(){
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show');
        },
        createProduct(){
            this.$Progress.start();
            this.form.end_date = moment(this.form.end_date).format('YYYY-MM-DD h:mm:ss');
            this.form.post('api/product')
            .then((data)=>{
              if(data.data.success){
                $('#addNew').modal('hide');

                Toast.fire({
                      icon: 'success',
                      title: data.data.message
                  });
                this.$Progress.finish();
                this.loadProducts();

              } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Some error occured! Please try again'
                });

                this.$Progress.failed();
              }
            })
            .catch(()=>{

                Toast.fire({
                    icon: 'error',
                    title: 'Some error occured! Please try again'
                });
            })
        },
        updateProduct(){
            this.$Progress.start();
            this.form.put('api/product/'+this.form.id)
            .then((response) => {
                // success
                $('#addNew').modal('hide');
                Toast.fire({
                  icon: 'success',
                  title: response.data.message
                });
                this.$Progress.finish();
                    //  Fire.$emit('AfterCreate');

                this.loadProducts();
            })
            .catch(() => {
                this.$Progress.fail();
            });

        },
        deleteProduct(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    // Send request to the server
                      if (result.value) {
                            this.form.delete('api/product/'+id).then(()=>{
                                    Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                    );
                                // Fire.$emit('AfterCreate');
                                this.loadProducts();
                            }).catch((data)=> {
                                Swal.fire("Failed!", data.message, "warning");
                            });
                      }
                })
        },

      },
      mounted() {
          
      },
      created() {
          this.$Progress.start();

          this.loadProducts();
          this.loadCategoriesAndUsers();

          this.$Progress.finish();
      },
      filters: {
          truncate: function (text, length, suffix) {
              return text.substring(0, length) + suffix;
          },
      }
  }
</script>
