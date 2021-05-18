import {LocalStorage, TokenStorage} from "../../LocalStorage";
import UriTransformer from "../../http/UriTransformer";
import axios from "../../http/axios";

declare var Routing: any;

class Switch {
  static async do() {
    if (TokenStorage.getApiTokenPreview()) {
      let original = TokenStorage.getApiTokenOriginal();
      await axios.get('/public/api/jwt/invalidate?token=' + TokenStorage.getApiToken());
      // eslint-disable-next-line no-undef
      let url = UriTransformer.transform(Routing.generate('backend_homepage', {_switch_user: original}));
      LocalStorage.unsetAll();
      window.location.href = url;
    }
  }
}

export default Switch
