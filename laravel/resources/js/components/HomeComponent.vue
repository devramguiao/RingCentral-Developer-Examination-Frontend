<template>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card card-default">
        <div class="card-header">
        <button type="button" class="btn btn-primary" v-on:click="getAPIResponse" >Ping</button>
        </div>
        <div class="card-body">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Date and Time</th>
                <th>HTTP Response</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="ping in pings" :key="ping.id">
                <td>{{ ping.id }}</td>
                <td style="width: 20%">{{ ping.currentDateTime }}</td>
                <td>{{ ping.httpResponse }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
      data() {
        return {
            ping:{
                currentDateTime: '',
                httpResponse: ''
              },
            pings: []
          }
        },
        created() {
            let uriGet = 'http://localhost:8000/api/pings';
          
            this.axios.get(uriGet).then(response => {
              this.pings = response.data.data;
            });
        },
        methods: {
          getAPIResponse(){
            let uriGetApi = 'http://localhost:3000/ringcentral-exam';
            let uriPost = 'http://localhost:8000/api/ping/create';

            this.axios.get(uriGetApi).then(response => {
              if (response.status == 200) {
                this.ping.currentDateTime = response.data.data.currentDateTime;
                this.ping.httpResponse = JSON.stringify(response);

                this.axios.post(uriPost, this.ping).then((response) => {
                    if (response.status == 200) {
                      this.reloadComponent();
                    }

                });
              }
            });
          },
          reloadComponent(){
            let uriGet = 'http://localhost:8000/api/pings';
          
            this.axios.get(uriGet).then(response => {
              this.pings = response.data.data;
            });
          }
        }      
      }
      // mounted() {
      //     console.log('Component mounted.')
      // }
    // }
</script>