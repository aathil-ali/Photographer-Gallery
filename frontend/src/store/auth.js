
// store/auth.js
const state = {
  token: localStorage.getItem('token') || '',
  status: '',
};

const getters = {
  isLoggedIn: (state) => !!state.token,
  authStatus: (state) => state.status,
  authToken: (state) => state.token,
};

const actions = {

  logout: async ({ commit }) => {
    try {
      // Call the API endpoint for user logout (if applicable)
      // For example, you might want to send a request to your backend to invalidate the token

      // Assuming you have an API endpoint for logout in your Laravel backend
      await fetch(`${process.env.VUE_APP_API_URL}/api/logout`, {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${state.token}`, // Include the token in the headers
          'Content-Type': 'application/json',
        },
      });

      // Remove the token from local storage and Vuex state
      localStorage.removeItem('token');
      commit('logout');

      // Return the success response to handle routing in the Vue component
      return { success: true };

    } catch (error) {
      // Return the error response to handle routing in the Vue component
      return { success: false, message: error.message };
    }
  },

  register: async ({ commit }, userData) => {
    try {
      const response = await fetch(`${process.env.VUE_APP_API_URL}/api/register`, {
        method: 'POST',
        body: userData,
      });

      const responseData = await response.json();

      if (responseData.success) {
        commit('SET_USER', responseData.user);

      } else {
        throw new Error(responseData.message);
      }

      // Handle successful registration response
      console.log('User successfully registered:', responseData);

      return { success: true };
      // Handle successful registration response
    } catch (error) {
      throw new Error(error.message);
    }
  },
  login: async ({ commit }, credentials) => {
    try {
      const response = await fetch(`${process.env.VUE_APP_API_URL}/api/login`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(credentials),
      });

      const responseData = await response.json();

      if (!response.ok) {
        throw new Error(responseData.message || 'Failed to login');
      }

      const token = responseData?.data?.authorization?.token;
      localStorage.setItem('token', token);
      commit('loginSuccess', token);

      // Return the success response to handle routing in the Vue component
      return { success: true };
    } catch (error) {
      commit('loginFailure', error.message);

      // Return the error response to handle routing in the Vue component
      return { success: false, message: error.message };
    }
  },

};

const mutations = {
  loginSuccess: (state, token) => {
    state.token = token;
    state.status = 'success';
  },
  loginFailure: (state, errorMessage) => {
    state.token = '';
    state.status = errorMessage;
  },
  logout: (state) => {
    state.token = '';
  },
  SET_USER(state, user) {
    state.user = user;
  },
};

export default {
  state,
  getters,
  actions,
  mutations,
};
