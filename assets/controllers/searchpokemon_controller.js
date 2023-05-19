import { Controller } from '@hotwired/stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    connect() {
        console.log("connected");
    }

    searchPokemon() {
        console.log("Hello, Stimulus!", this.element)
        fetch('../../?get_pokemon=1')
        .then(function(response) {
                console.log(response)
            })
        .catch(err => console.log(err))
      }
}
