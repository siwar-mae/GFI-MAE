import {LocalStorage, UserStorage} from "../../LocalStorage";
import Axios from "../../http/axios";
import UriTransformer from "../../http/UriTransformer";

declare var Routing: any;
class Me {
  static async get(axiosConfig: Object = {redirect: true}) {
    let user = {};
    if (JSON.stringify(UserStorage.getUser()) === '{}') {
      try {
        // eslint-disable-next-line no-undef
        await Axios.get(UriTransformer.transform(Routing.generate('api_coreui_me')), axiosConfig).then(
          (response) => {
            try {
              if (response.data.code === 401 && response.data.public === true) {
                LocalStorage.unsetAll();
                return;
              }
            } catch (exception) {

            }
            user = response.data;
          },
          (error) => {
          }
        ).catch(error => {
        });
      } catch (exception) {
      }
      return user
    }
    return UserStorage.getUser();
  }
}

export default Me
