<template>
  <fragment>
    <car-guest  @remove="remove"  :car="this.car" ref="car" :user_name="this.user_name" :user_id="this.user_id"/>
    <div class="d-flex mb-3 h-100 flex-wrap">
      <a v-for="tag in tags" :key="tag.id" @click="plats_filter(tag.id)">
        <div
          class="tag ml-2 mb-2 btn text-nowrap"
          :style="'background-color:' + tag.color"
        >{{tag.name}}</div>
      </a>
      <a @click="all_plats()">
        <div class="tag ml-2 mb-2 btn text-nowrap" style="background-color: #a5a5a5">All</div>
      </a>
    </div>
    <div v-if="plats.length > 0" class="row">
      <div  v-for="plat in plats" :key="plat.id" class="well col-md-3">
        <div  class="card mb-4 shadow-sm"  :style="'border-top: 5px solid' + plat.tag.color">
         
            <div class="overflow-hidden d-flex align-items-center" style="height:225px;">
                <img class="bd-placeholder-img card-img-top" width="100%"  :src="'/storage/images/' + plat.imgLink" alt="">
            </div>

            <div class="card-body p-3">
                <!--a :href="'/menu/'+ plat.id"><p class="card-text">{{plat.name}}</p></a-->
                <p class="card-text">{{plat.name}}</p>
                <h2 class="text-right">{{plat.price}}€</h2>
                
                <div class="d-flex justify-content-between align-items-center">
                  <small class="text-muted">{{getDate(plat.created_at)}}</small>
                  <div class="btn btn-primary" @click="add(plat)">ADD</div>
                </div>
            </div>
        </div>
    </diV>
    </div>
    <div v-else>
        <p>No Menu found</p>
    </div>
  </fragment>
</template>

<script>
const Swal = require('sweetalert2')

export default {
  props: {
  	user_name: {
      type: String,
    },
    	user_id: {
      type: String,
  	},
  },
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      tags: [],
      plats:[],
      platsCopy:[],
      car:[],
    };
  },
  created() {
    axios.get("/carta/" + this.user_name).then(res => {
      this.tags = res.data.tags;
      this.plats = res.data.menus
      this.platsCopy =  this.plats.filter( menu => menu.in_stock == 1);
      //this.tags = this.tags.filter(tag)
      let array1 = this.plats.map(plat => parseInt(plat.tag_id)).unique();
      //array1 = [0,1]
      this.tags = this.tags.filter(tag => array1.includes(tag.id));

      console.log(res.data)
    });

    
  },
  methods: {
    add(item){
    let element = this;
     Swal.fire({
        title: 'Quantitat?',
       // icon: 'question',
         imageHeight: 200,
        input: 'range',
        imageUrl: '/storage/images/' + item.imgLink,
        showCancelButton: true,
        inputAttributes: {
          min: 1,
          max: 20,
          step: 1
        },
        inputValue: 1
      }).then(function (result) {
        
        if (result.value) {
          let product = {
            plat:element.plats.filter(plat => plat.id == item.id)[0],
            value:result.value
          }
          element.car.push(product)
          
          element.$refs.car.update(   element.car.reduce(function (acc, obj) { return acc + parseInt(obj.value) * parseFloat(obj.plat.price)}, 0).toFixed(2) )


        }
      })
    },
    remove(id){
      this.car = this.car.filter(car => car.plat.id != id);
      this.$refs.car.update(this.car.reduce(function (acc, obj) { return acc + parseInt(obj.value) * parseFloat(obj.plat.price)}, 0).toFixed(2) )

    },
    getDate(datetime) {
      let date = new Date(datetime).toJSON().slice(0,19 ).replace(/-/g,'/')
      return date.replace('T',' ');
    },
    plats_filter(id){
      this.plats = this.platsCopy.filter(plat => plat.tag_id == id);
    },
    all_plats(){
      this.plats = this.platsCopy;
    },
  }
};
</script>
