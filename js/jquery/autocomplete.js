/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {
    $("#auto").autocomplete({
        source: "search.php",
        minLength: 2
    });
});
