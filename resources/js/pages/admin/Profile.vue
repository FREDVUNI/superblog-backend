<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="">
                    <!-- <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>posts</h1>
                            </div>
                            </div>
                        </div>
                        </section> -->
                        <section class="content">
                        <div class="container-fluid">
                        <div class="alert alert-success" v-show="alert">The profile has been saved.</div>
                            <div class="row">
                            <div class="col-12">
                                <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Profile</h3>
                                </div>
                                <div class="card-body">
                                   <form @submit.prevent="EditProfile" enctype="multipart/form-data">
                                       <div class="form-group">
                                           <label for="name">Name</label>
                                           <input type="text" class="form-control" :class="{'is-invalid':form.errors.has('name')}" @keydown="form.errors.clear('name')" v-model="form.name" placeholder="Enter user name">
                                           <span class="text-danger" v-show="form.errors.has('name')" v-text="form.errors.get('name')"></span>
                                       </div>
                                       <div class="form-group">
                                           <label for="email">Email</label>
                                           <input type="email" class="form-control" :class="{'is-invalid':form.errors.has('email')}" @keydown="form.errors.clear('email')" v-model="form.email" placeholder="Enter user email">
                                           <span class="text-danger" v-show="form.errors.has('email')" v-text="form.errors.get('email')"></span>
                                       </div>
                                       <div class="form-group mt-2">
                                            <button type="submit" class="btn btn-sm btn-primary">save changes</button>
                                        </div>
                                    </form> 
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";
    export default {
        data(){
            return{
                form:new Form({
                    name:"",
                    email:""
                }),
                profile:{},
                alert:false
            }
        },
        methods:{
            getprofile(){
                axios.get("/api/profile")
                .then((resp)=>{
                    this.profile = resp.data
                    this.form.name = resp.data.name
                    this.form.email = resp.data.email
                })
                .catch((error)=>{
                    console.log(`something went wrong. ${error}`);
                })
            },
            EditProfile(){
                let data = new FormData()
                data.append("name",this.form.name)
                data.append("email",this.form.email)

                axios.post("/api/profile",data)
                .then((resp)=>{
                    this.alert = true
                    this.getprofile()
                })
                .catch((error)=>{
                     this.form.errors.record(error.response.data)
                    console.log(`something went wrong. ${error}`);
                })
            }
        },
        mounted() {
            this.getprofile()
            console.log('Component mounted.')
        }
    }
</script>
