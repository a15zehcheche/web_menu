<template>
  <fragment>
    <h1
      type="button"
      class="btn btn-primary car_icon"
      data-toggle="modal"
      data-target="#exampleModal"
    >&lt;</h1>
    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body h-75">
            <label for="name">your name:</label>
            <input type="text" v-model="client_name" />
            <div class="orders-list d-block ml-1 mr-1 rounded">
              <div
                v-for="(plat,index) in car"
                :key="index"
                class="order bg-light ml-2 mr-2 rounded mb-2 overflow-hidden"
              >
                <div class="row h-100">
                  <div class="col-4 d-flex justify-content-center align-items-center">
                    <img class="w-100" :src="'/storage/images/' + plat.plat.imgLink" alt="plat" />
                  </div>
                  <div class="col-8">
                    <div class="row h-50">
                      <div class="col d-flex align-items-center">
                        <p>x {{plat.value}}</p>
                      </div>
                      <div class="col d-flex align-items-center justify-content-around">
                        <div>
                          <button class="btn btn-danger" @click="remove(plat.plat.id)" href>delete</button>
                        </div>
                      </div>
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
            </div>
            <div>{{price_total}}</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="order()">Order</button>
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
    },
    user_id: {
      type: String
    },
    car: {
      type: Array
    }
  },
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      isActive: false,
      cars: [1, 2, 3, 4, 5, 6],
      price_total: 0,
      client_name: ""
    };
  },
  created() {},
  methods: {
    update(data) {
      this.price_total = data;
    },
    getDate(datetime) {
      let date = new Date(datetime)
        .toJSON()
        .slice(0, 19)
        .replace(/-/g, "/");
      return date.replace("T", " ");
    },
    remove(id) {
      this.$emit("remove", id);
      //this.car = this.car.filter(car => car.plat.id != id);
    },

    order() {
      var socket = io("http://192.168.1.140:3000");

      console.log({
        plats: this.car.map(plat => {
          return { id: plat.plat, number: plat.value };
        })
      });
      let elemet = this;
      if (this.client_name != "" && this.car.length > 0) {
        axios
          .post("/order", {
            user_id: elemet.user_id,
            client_name: elemet.client_name,
            json_plats: elemet.car.map(plat => {
              return { plat: plat.plat, number: plat.value };
            })
          })
          .then(function(response) {
            console.log(response);
            socket.emit("order" + elemet.user_name,response.data);
          })
          .catch(function(error) {
            console.log(error);
          });

        // alert("order.")
      } else {
        alert("reqire name! or car empty");
      }
    }
  }
};
</script>

<style scoped>
.order {
  /*height: 200px;*/
}
.orders-list {
  height: 100%;
  overflow: hidden;
  overflow-y: scroll;
}
</style>