
<template>
  <fragment>
    <ul>
      <li v-for="(msg,index) in msgs" :key="index">{{msg}}</li>
    </ul>

    <div v-for="(order,index) in this.orders" :key="index" class="card bg-primary p-3 mb-3">
      <h2>{{order.client_name}}</h2>
      <div v-for="(plat,index) in order.plats" :key="index" class="plat row m-0 w-100 bg-light">
        <div class="col-4 d-flex justify-content-center align-items-center h-100">
          <img :src="'/storage/images/'+plat.plat.imgLink" alt="plat" class="h-100" />
        </div>
        <div class="col-8">
          <div class="row h-50">
            <div class="col d-flex align-items-center">
              <p>x {{plat.number}}</p>
            </div>
            <div class="col d-flex align-items-center justify-content-around"></div>
          </div>
          <div class="row h-50">
            <div class="col">
              <p>{{plat.plat.name}}</p>
            </div>
            <div class="col">
              <p>{{plat.plat.price}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </fragment>
</template>

<script>
export default {
  props: {
    user_name: {
      type: String
    }
  },
  data() {
    return {
      msgs: [],
      orders: []
    };
  },
  mounted() {
    console.log("Component order mounted.");
    var socket = io("http://192.168.1.140:3000");
    let elemet = this;
    socket.on("order" + this.user_name, function(data) {
      elemet.msgs.push(data);
      setTimeout(function() {
        elemet.update_data();
      }, 500);
    });
  },

  created() {
    this.update_data();
  },
  methods: {
    update_data() {
      axios.get("/getOrder").then(res => {
        this.orders = res.data;
        for (let i = 0; i < this.orders.length; i++) {
          this.orders[i].plats = JSON.parse(this.orders[i].plats);
        }

        console.log(this.orders);
      });
    }
  }
};
</script>

<style scoped>
.plat {
  height: 100px;
}
</style>