<template>
  <div class="container mx-auto px-4 h-full">
    <div class="flex content-center items-center justify-center h-full">
      <div class="w-full lg:w-6/12 px-4">
        <div
          class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-200 border-0"
        >
          <div class="rounded-t mb-0 px-6 py-6">
            <div class="text-center mb-3">
              <h6 class="text-blueGray-500 text-sm font-bold">Sign up</h6>
            </div>

            <div
              v-if="alertOpen"
              :class="alertColor"
              class="text-white px-6 py-4 border-0 rounded relative mb-4"
            >
              <span class="text-xl inline-block mr-5 align-middle">
                <i class="fas fa-bell"></i>
              </span>
              <span class="inline-block align-middle mr-9">
                <b class="capitalize"> </b> {{ alertMessage }}
              </span>
              <button
                class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none"
                v-on:click="closeAlert()"
              >
                <span>×</span>
              </button>
            </div>

            <hr class="mt-6 border-b-1 border-blueGray-300" />
          </div>
          <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
            <form @submit.prevent="registerUser">
              <div class="relative w-full mb-3">
                <label
                  class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                  htmlFor="name"
                >
                  Name
                </label>
                <input
                  type="text"
                  v-model="name"
                  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  placeholder="Name"
                  required="required"
                />
              </div>

              <div class="relative w-full mb-3">
                <label
                  class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                  htmlFor="email"
                >
                  Email
                </label>
                <input
                  type="email"
                  v-model="email"
                  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  placeholder="Email"
                  required="required"
                />
              </div>

              <div class="relative w-full mb-3">
                <label
                  class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                  htmlFor="password"
                >
                  Password
                </label>
                <input
                  type="password"
                  v-model="password"
                  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  placeholder="Password"
                  required="required"
                />
              </div>

              <div class="relative w-full mb-3">
                <label
                  class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                  htmlFor="phone"
                >
                  phone
                </label>
                <input
                  type="phone"
                  v-model="phone"
                  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  placeholder="Phone"
                  required="required"
                />
              </div>

              <div class="relative w-full mb-3">
                <label
                  class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                  htmlFor="picture"
                >
                  picture
                </label>
                <input
                  type="file"
                  @change="handleFileUpload"
                  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  placeholder="picture"
                  required="required"
                />
              </div>

              <div class="relative w-full mb-3">
                <label
                  class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                  htmlFor="bio"
                >
                  Bio
                </label>
                <textarea
                  v-model="bio"
                  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  name="bio"
                  id="bio"
                  cols="30"
                  rows="5"
                ></textarea>
              </div>

              <div>
                <label class="inline-flex items-center cursor-pointer">
                  <input
                    id="customCheckLogin"
                    type="checkbox"
                    required="required"
                    class="form-checkbox border-0 rounded text-blueGray-700 ml-1 w-5 h-5 ease-linear transition-all duration-150"
                  />
                  <span class="ml-2 text-sm font-semibold text-blueGray-600">
                    I agree with the
                    <a href="javascript:void(0)" class="text-emerald-500">
                      Privacy Policy
                    </a>
                  </span>
                </label>
              </div>

              <div class="text-center mt-6">
                <button
                  class="bg-blueGray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150"
                  type="submit"
                >
                  Create Account
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "",
      email: "",
      password: "",
      phone: "",
      bio: "",
      picture: null,
      alertOpen: false,
      errorMessage: "",
      alertColor: "bg-green-500",
      alertMessage: "",
    };
  },
  methods: {
    handleFileUpload(event) {
      const file = event.target.files[0];

      if (file) {
        // You can access file properties here if needed
        console.log("Selected file:", file);

        // Update the data property
        this.picture = file;
        console.log("eee", this.picture);
      }
    },
    closeAlert() {
      this.alertOpen = false;
    },

    async registerUser() {


      try {
      let self = this;

      self.alertMessage = "";
      self.alertOpen = false;
      self.alertColor = "";

      // Create a FormData object
      const formData = new FormData();
        formData.append('name', this.name);
        formData.append('email', this.email);
        formData.append('password', this.password);
        formData.append('phone_number', this.phone);
        formData.append('bio', this.bio);

        // Check if the picture is not null before appending
        if (this.picture) {
          formData.append('picture', this.picture);
        }

      console.log(formData);


      // Validate form fields
      if (!self.name) self.errorMessage = "Name is required";
      if (!self.email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(self.email))
        self.errorMessage = "Invalid email format";
      if (!self.password || self.password.length < 8)
        self.errorMessage = "Password must be at least 8 characters";
      if (!self.phone || !/^\d{10}$/.test(self.phone))
        self.errorMessage = "Invalid phone number format";
      if (!self.bio) self.errorMessage = "Bio is required";

      if (self.errorMessage.length) {
        self.alertMessage = self.errorMessage;
        self.alertOpen = true;
        self.alertColor = "bg-red-500";

        return;
      }

     
        console.log(formData);
        // Append the FormData to the API call
        let response = await self.$store.dispatch("register", formData);

        self.alertColor = "bg-emerald-500";
        self.alertOpen = true;
        self.alertMessage = "Registration success";
        self.name = " ";
        self.email = " ";
        self.password = " ";
        self.phone = " ";
        self.bio = " ";

        if (response.success) {
          setTimeout(() => {
            // Proceed with registration after the delay
            this.$router.push("/auth/login");
            // Call your API or dispatch an action to register the user
          }, 5000);
        }

        // Handle successful registration
      } catch (error) {
        // Handle registration failure
        self.errorMessage = error;
        self.alertMessage = self.errorMessage;
        self.alertOpen = true;
        self.alertColor = "bg-red-500";
      }
    },
  },
};
</script>
<style scoped>
span.inline-block.align-middle.mr-9 {
  padding: 8px;
}

button.absolute.bg-transparent.text-2xl.font-semibold.leading-none.right-0.top-0.mt-4.mr-6.outline-none.focus\:outline-none {
  padding: 10px;
}
</style>