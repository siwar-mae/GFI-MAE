import Axios from "axios";
import locale from '../../i18n/locale/locale'
import {LocalStorage, TokenStorage} from "../LocalStorage/index";
import UriTransformer from "../../utils/http/UriTransformer";

Axios.interceptors.request.use((config) => {
  if (TokenStorage.getApiToken() !== null) {
    config.headers['Authorization'] = 'Bearer ' + TokenStorage.getApiToken();
    if (config.url.indexOf('?') === -1) {
      config.url += '?';
    }
    if (config.url.indexOf('token=') === -1) {
      if (config.url.endsWith('?')) {
        config.url += 'token=' + TokenStorage.getApiToken();
      } else {
        config.url += '&token=' + TokenStorage.getApiToken();
      }
    }

  }
  config.url = UriTransformer.transform(config.url);
  config.headers['locale'] = locale;

  return config;
}, (error) => {
  alert('Whoops! something went wrong! see console');
  console.log(error);
  return Promise.reject(error);
});
Axios.interceptors.response.use((response) => {
  try {
    if (response.data.code === 401 && response.data.public === true) {
      LocalStorage.unsetAll();
      console.log("Error public : ");
      console.log(Object.getOwnPropertyNames(response));
      console.log(JSON.stringify(response));
      return Promise.reject(response);
    }
  } catch (exception) {

    console.log("Error exception : ");
    console.log(Object.getOwnPropertyNames(response));
    console.log(JSON.stringify(response));
  }
  return response;
}, (error) => {
  console.log("Error rejected : ");
  console.log(Object.getOwnPropertyNames(error));
  if (error.stack) {
    console.log(error.stack);
  }
  if (error.message) {
    console.log(error.message);
  }

  console.log(JSON.stringify(error));
  let httpCode = '';
  let message = '';
  try {
    httpCode = error.response.data.code || error.response.status || error.response.statusText;
    message = error.response.data.message;
  } catch (exception) {
    message = error.message;
  }
  let httpRoute = error.config.url;
  // eslint-disable-next-line no-undef
  if (httpCode === 401 && httpRoute !== Routing.generate('api_coreui_login_check') && (message === 'Expired JWT Token' || message === 'JWT Token not found')) {
    LocalStorage.unsetAll();

    console.log("Error not auth : ");
    console.log(Object.getOwnPropertyNames(error));
    console.log(JSON.stringify(error));
    window.location.reload();
  } else {
    console.log('Whoops! something went wrong! see console');
    console.log(error);
    console.log(error.response);
    console.log(UriTransformer.transform(window.location.href.split(window.location.host)[1]));
    window.location.href = UriTransformer.transform(window.location.href.split(window.location.host)[1]);
  }

  return Promise.reject(error);
});

export default Axios;
