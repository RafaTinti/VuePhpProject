
<template>
  <div class="mt-5 container">
    <div class="card mx-auto">
      <div class="card-header py-3 d-flex align-center justify-content-between">
        <h4>
          Customers
        </h4>
        <RouterLink class="btn btn-primary" to="/customers/create">Add Customer</RouterLink>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-responsive table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Date of Birth</th>
              <th>Username</th>
              <th>Password</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody v-if="this.customers.length > 0">
            <tr v-for="(customer, index) in this.customers" :key="index">
              <td>{{ customer.ID }}</td>
              <td>{{ customer.FirstName }}</td>
              <td>{{ customer.LastName }}</td>
              <td>{{ customer.DateOfBirth }}</td>
              <td>{{ customer.Username }}</td>
              <td>{{ customer.Password }}</td>
              <td class="d-flex justify-content-evenly">
                <RouterLink :to="{ path: `/customers/${customer.ID}/edit` }" class="btn btn-sm btn-primary">Edit
                </RouterLink>
                <button type="button" class="btn btn-sm btn-danger">Delete</button>
              </td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td colspan="7">Loading...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
  
<script>
import axios from "axios";
import { curPage } from '../../main.js';
export default {
  name: "customers",
  data() {
    return {
      customers: [],
    }
  },

  mounted() {
    curPage.setPage("Customers");
    this.getCustomers();
  },

  methods: {
    getCustomers() {
      axios.get("http://localhost/vuephpproject/backend/api/customer/readAll.php").then(res => {
        this.customers = res.data.data;
        console.log(this.customers);
      }).catch(err =>{
        console.log(err);
      })
    }
  }
}
</script>

<style scoped>
.card {
  max-width: 998px;
}</style>