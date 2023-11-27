
<template>
  <div class="mt-5 container">
    <div class="card mx-auto">
      <div class="card-header py-3 d-flex align-center justify-content-between">
        <h4>
          Edit Customer {{ this.$route.params.id }}
        </h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="mb-3 col-sm-6">
            <label for="FirstName" class="form-label fw-bold">First Name</label>
            <input type="text" class="form-control" v-model="model.customer.FirstName" name="FirstName" id="FirstName"
              placeholder="Enter your first name...">
          </div>
          <div class="mb-3 col-sm-6">
            <label for="LastName" class="form-label fw-bold">Last Name</label>
            <input type="text" class="form-control" v-model="model.customer.LastName" name="LastName" id="LastName"
              placeholder="Enter your last name...">
          </div>
        </div>
        <div class="row">
          <div class="mb-3 col-sm-4">
            <label for="Username" class="form-label fw-bold">Username</label>
            <input type="text" class="form-control" v-model="model.customer.Username" name="Username" id="Username">
          </div>
          <div class="mb-3 col-sm-4">
            <label for="Password" class="form-label fw-bold">Password</label>
            <input type="text" class="form-control" v-model="model.customer.Password" name="Password" id="Password">
          </div>
          <div class="mb-3 col-sm-4">
            <label for="DateOfBirth" class="form-label fw-bold">Date of Birth</label>
            <input type="date" class="form-control" v-model="model.customer.DateOfBirth" name="DateOfBirth"
              id="DateOfBirth">
          </div>
          <div class="my-3">
            <button type="button" @click="updateCustomer" class="btn btn-primary float-end">Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';
import { curPage } from '../../main.js';

export default {
  name: "CustomerEdit",
  data() {
    return {
      model: {
        customer: {
          ID : "",
          FirstName: "",
          LastName: "",
          DateOfBirth: "",
          Username: "",
          Password: "",
        }
      }
    }
  },
  mounted() {
    curPage.setPage("Customers");
    console.log(this.$route.params.id);
    this.getCustomerData(this.$route.params.id)
  },
  methods: {
    getCustomerData(id){
      axios({
        method: 'GET',
        url: "http://localhost/vuephpproject/backend/api/customer/read.php?id="+id,
      }).then(res => {
        console.log(res.data.data);
        const c = res.data.data;
        this.model.customer = c;
      }).catch(err =>{
        console.log(err.response.data.message);
        Swal.fire({
          icon: "warning",
          title: "Error",
          text: err.response.data.message,
        })
        this.$router.push({ path: '/customers' });
      })
    },
    updateCustomer() {
      const msg = this.validateCustomer();
      if (msg) {
        Swal.fire({
          icon: "warning",
          title: "Missing required fields",
          text: msg,
        })
        return;
      }
      axios({
        method: 'PUT',
        withCredentials: false,
        url: "http://localhost/vuephpproject/backend/api/customer/update.php",
        data: this.model.customer,
      })
        .then(res => {
          console.log(res);
          Swal.fire({
            icon: "success",
            title: "Success",
            text: res.data.message,
          })
          this.$router.push({ path: '/customers' });
        })
        .catch(err => {
          console.log(err);
          Swal.fire({
            icon: "error",
            title: "Error",
            text: err.message,
          })
        })
    },

    validateCustomer() {
      // validate
      let msg = "";
      if (!this.model.customer.FirstName) {
        msg += "Field First Name is required, ";
      }
      if (!this.model.customer.LastName) {
        msg += "Field Last Name is required, ";
      }
      if (!this.model.customer.DateOfBirth) {
        msg += "Field Date of Birth is required, ";
      }
      if (!this.model.customer.Username) {
        msg += "Field Username is required, ";
      }
      if (!this.model.customer.Password) {
        msg += "Field Password is required, ";
      }

      if (msg.length > 0) {
        msg = msg.slice(0, -2);
        msg += '.';
      }
      return msg;
    }
  }
}
</script>

<style scoped>
.card {
  max-width: 998px;
}</style>