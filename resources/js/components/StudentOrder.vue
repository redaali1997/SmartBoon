<template>
  <div>
    <h4>
      From
      {{ start > 12 ? start -12 + ' PM' : start + ' AM' }}
      To
      {{ end > 12 ? end -12 + ' PM' : end + ' AM' }}
    </h4>
    <hr />
    <div v-if="activated && available && reserved">
      <button type="submit" class="btn btn-danger" @click="cancelOrder">Cancel Reservation</button>
    </div>
    <div v-else-if="activated && available && !reserved">
      <button type="submit" class="btn btn-primary" @click="createOrder">Reserve</button>
    </div>
    <div class="alert alert-info" v-if="!available">Reserving time has been ended.</div>
    <div class="alert alert-info" v-if="!activated">Please renew the subscription.</div>
  </div>
</template>

<script>
export default {
  props: [
    "start",
    "end",
    "order",
    "reserved",
    "available",
    "activated",
    "username",
    "password"
  ],
  data() {
    return {
      access_token: ""
    };
  },
  methods: {
    createOrder() {
      axios
        .post("http://127.0.0.1:8000/api/create-order/", {
          headers: {
            Accept: "application/json",
            Authorization: "Bearer " + this.access_token
          }
        })
        .then(response => {
          console.log("Done");
        })
        .catch(error => {
          console.log("Error");
        });
    },
    cancelOrder() {
      axios
        .post("http://127.0.0.1:8000/api/cancel-order/", {
          headers: {
            Accept: "application/json",
            Authorization: "Bearer " + this.access_token
          }
        })
        .then(response => {
          console.log("Done");
        })
        .catch(error => {
          console.log("Error");
        });
    }
  },
  created() {
    axios
      .post("http://127.0.0.1:8000/oauth/token", {
        grant_type: "password",
        client_id: 2,
        client_secret: "rZSyhTiqGYJHAqqK0lu2zi4aslQIGzR1AmTsFZgW"
      })
      .then(response => {
        this.access_token = response.data.access_token;
        console.log(response);
      })
      .catch(error => {
        console.log(error);
      });
  }
};
</script>
