
<template>
  <fragment>
    <ul>
      <li v-for="(msg,index) in msgs" :key="index">{{msg}}</li>
    </ul>
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
      msgs: ["hola"],
      plats:[]
  };
  },
  mounted() {
    console.log("Component order mounted.");
    var socket = io("http://192.168.1.140:3000");
    let elemet = this;
    socket.on("order"+this.user_name, function(data) {
      elemet.msgs.push(data);
    });
  },
 
  created() {
    console.log("Component order crater.");
  },
  methods: {}
};
</script>
