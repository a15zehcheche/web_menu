
<template>
  <fragment>
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
      <div  v-for="plat in plats" :key="plat.id"  class="well col-md-3">
        <div class="card mb-4 shadow-sm"  :style="'border-top: 5px solid' + plat.tag.color">
          <img v-if="!plat.in_stock" class="h-100 w-100 position-absolute" src="/storage/web/red-cross.png" alt="">
            <div class="overflow-hidden d-flex align-items-center" style="height:225px;">
                <img class="bd-placeholder-img card-img-top" width="100%"  :src="'/storage/images/' + plat.imgLink" alt="">
            </div>

            <div class="card-body p-3">
                <a :href="'/menu/'+ plat.id"><p class="card-text">{{plat.name}}</p></a>
                <h2 class="text-right">{{plat.price}}€</h2>
                
                <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">{{getDate(plat.created_at)}}</small>

                    <div class="btn-group">
                         <button class="btn btn-outline-danger btn-sm"  @click="eliminarPlat(plat, index)">Delete</button>
                         <a class="btn  btn-sm btn-outline-secondary " :href="'/menu/'+ plat.id + '/edit'">Edit</a>
                    </div>
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
export default {
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      tags: [],
      plats:[],
      platsCopy:[],
    };
  },
  created() {
    axios.get("/getData").then(res => {
      this.tags = res.data.tags;
      this.platsCopy = this.plats = res.data.menus;
      console.log(res.data)
    });
    
  },
  methods: {
     getDate(datetime) {
      let date = new Date(datetime).toJSON().slice(0,19 ).replace(/-/g,'/')
      return date.replace('T',' ');
    },
    eliminarPlat(plat, index) {
        this.plats.splice(index, 1);
        axios.delete(`/menu/${plat.id}`).then(() => {
        
        });
    },
    plats_filter(id){
      this.plats = this.platsCopy.filter(plat => plat.tag_id == id);
    },
    all_plats(){
      this.plats = this.platsCopy;
    }

  }
};
</script>
