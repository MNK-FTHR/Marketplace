<template>
  <section class="content">
    <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des enchères</h3>

                <div class="card-tools">
                  
                  <button type="button" class="btn btn-sm btn-primary" @click="newModal">
                      <i class="fa fa-plus-square"></i> 
                      Ajouter
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Enchère</th>
                      <th>Produit</th>
                      <th>Utilisateur</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="bidding in biddings.data" :key="bidding.id">

                      <td>{{bidding.id}}</td>
                      <td>{{bidding.bid}}</td>
                      <td>{{bidding.product_id}}</td>
                      <td>{{bidding.user_id}}</td>
                      <td>{{bidding.created_at}}</td>
                      <!-- <td><img v-bind:src="'/' + bidding.photo" width="100" alt="bidding"></td> -->
                      <td>
                        
                        <a href="#" @click="editModal(bidding)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deletebidding(bidding.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="biddings" @pagination-change-page="getResults"></pagination>
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
                    <h5 class="modal-title" v-show="!editmode">Create New bidding</h5>
                    <h5 class="modal-title" v-show="editmode">Edit bidding</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form @submit.prevent="editmode ? updatebidding() : createbidding()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Enchère</label>
                            <input v-model="form.bid" type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('bid') }">
                            <has-error :form="form" field="bid"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Produit</label>
                            <select class="form-control" v-model="form.product_id">
                              <option 
                                  v-for="product in products" :key="product.id"
                                  :value="product.id"
                                  :selected="product.id == form.product_id">{{ product.name }} - {{ product.price }}€</option>
                            </select>
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

    export default {
        data () {
            return {
                editmode: false,
                biddings : {},
                form: new Form({
                    id : '',
                    bid : '',
                    product_id: '',
                    user_id: '',
                }),
                users: [],
                products: []
              }
        },
        methods: {

          getResults(page = 1) {

              this.$Progress.start();
              
              axios.get('api/bidding?page=' + page).then(({ data }) => (this.biddings = data.data));

              this.$Progress.finish();
          },
          loadbiddings(){
              axios.get("api/bidding").then(({ data }) => (this.biddings = data.data));
          },
          loadUsersAndProducts(){
              axios.get("/api/user").then(({ data }) => (this.users = data.data));
              axios.get("/api/product").then(({ data }) => (this.products = data.data.data));
          },
          editModal(bidding){
              this.editmode = true;
              this.form.reset();
              $('#addNew').modal('show');
              this.form.fill(bidding);
          },
          newModal(){
              this.editmode = false;
              this.form.reset();
              $('#addNew').modal('show');
          },
          createbidding(){
              this.$Progress.start();

              this.form.post('api/bidding')
              .then((data)=>{
                if(data.data.success){
                  $('#addNew').modal('hide');

                  Toast.fire({
                        icon: 'success',
                        title: data.data.message
                    });
                  this.$Progress.finish();
                  this.loadbiddings();

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
          updatebidding(){
              this.$Progress.start();
              this.form.put('api/bidding/'+this.form.id)
              .then((response) => {
                  // success
                  $('#addNew').modal('hide');
                  Toast.fire({
                    icon: 'success',
                    title: response.data.message
                  });
                  this.$Progress.finish();
                      //  Fire.$emit('AfterCreate');

                  this.loadbiddings();
              })
              .catch(() => {
                  this.$Progress.fail();
              });

          },
          deletebidding(id){
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
                              this.form.delete('api/bidding/'+id).then(()=>{
                                      Swal.fire(
                                      'Deleted!',
                                      'Your file has been deleted.',
                                      'success'
                                      );
                                  // Fire.$emit('AfterCreate');
                                  this.loadbiddings();
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

            this.loadbiddings();
            this.loadUsersAndProducts();

            this.$Progress.finish();
        },
        filters: {
            truncate: function (text, length, suffix) {
                return text.substring(0, length) + suffix;
            },
        }
    }
</script>
