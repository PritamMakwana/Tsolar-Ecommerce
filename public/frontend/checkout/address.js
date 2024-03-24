function getAddressObject(address_components) {
    console.log(address_components);

    var ShouldBeComponent = {
        line1: ["street_number"],
        line2: ["street_address", "route", "neighborhood"],
        city: [
            "locality",
            "sublocality",
            "sublocality_level_1",
            "sublocality_level_2",
            "sublocality_level_3",
            "sublocality_level_4",
        ],
        state: [
            "administrative_area_level_1",
            "administrative_area_level_2",
            "administrative_area_level_3",
            "administrative_area_level_4",
            "administrative_area_level_5",
        ],
        country: ["country"],
        postal_code: ["postal_code"],
    };

    var address = {
        line1: "",
        line2: "",
        city: "",
        state: "",
        country: "",
        postal_code: "",
    };
    
    address_components.forEach((component) => {
        for (var shouldBe in ShouldBeComponent) {
            if (ShouldBeComponent[shouldBe].indexOf(component.types[0]) !== -1) {
                address[shouldBe] = component.long_name;
            }
        }
    });

    return address;
}

function mapAddressComponentsToFormFields(components, formFields) {
    var address = getAddressObject(components);
    formFields.line1.val(address.line1);
    formFields.line2.val(address.line2);
    formFields.city.val(address.city);
    formFields.state.val(address.state);
    formFields.country.val(address.country);
    formFields.zip.val(address.postal_code);
}

function initializeAutocomplete(inputElement, formFields) {
//     var autocomplete = new google.maps.places.Autocomplete(inputElement, {
//         componentRestrictions: { country: ["CA","US"] }, // Replace 'COUNTRY_CODE' with the desired ISO 3166-1 alpha-2 country code (e.g., 'US' for United States)
//     });

    var autocomplete = new google.maps.places.Autocomplete(inputElement);

    autocomplete.addListener("place_changed", function () {
        var place = autocomplete.getPlace();

        // Clear form fields before mapping new data
        Object.values(formFields).forEach(function (field) {
            field.val("");
        });

        if (place.address_components) {
            mapAddressComponentsToFormFields(
                place.address_components,
                formFields
            );
        }

        // Set latitude and longitude values
        if (place.geometry && place.geometry.location) {
            formFields.latitude.val(place.geometry.location.lat());
            formFields.longitude.val(place.geometry.location.lng());

            // Only used in when creating an estimate from admin side
            var show_latitude = document.getElementById("show_latitude");
            if(show_latitude) {
                $('#show_latitude').html(place.geometry.location.lat());
                $('#show_longitude').html(place.geometry.location.lng());
            }
        }
    });
}

$(function () {
    // Initialize 'new_address' autocomplete
    initializeAutocomplete(document.getElementById("new_address"), {
        line1: $("#line1"),
        line2: $("#line2"),
        city: $("#city"),
        state: $("#state"),
        country: $("#country"),
        zip: $("#zip"),
        latitude: $("#latitude"),
        longitude: $("#longitude"),
    });
});
$(document).ready(() => {
    $(".editButton").on("click", function () {
        let line1 = $(this).data("line1");
        let line2 = $(this).data("line2");
        let city = $(this).data("city");
        let state = $(this).data("state");
        let country = $(this).data("country");
        let zip = $(this).data("zip");
        let type = $(this).data("type");
        let id = $(this).data("id");
        let latitude = $(this).data("latitude");
        let longitude = $(this).data("longitude");

        $("#editLine1").val(line1);
        $("#editLine2").val(line2);
        $("#editCity").val(city);
        $("#editState").val(state);
        $("#editCountry").val(country);
        $("#editZip").val(zip);
        $("#editLatitude").val(latitude);
        $("#editLongitude").val(longitude);
        $("#address_id").val(id);

        // Set the value for the editType select element using Niceselect's update method
        $("#editType").val(type);
        $("#editType").niceSelect("update");

        var geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(latitude, longitude);

        // Initialize 'editNewAddress' autocomplete
        initializeAutocomplete(document.getElementById("editNewAddress"), {
            line1: $("#editLine1"),
            line2: $("#editLine2"),
            city: $("#editCity"),
            state: $("#editState"),
            country: $("#editCountry"),
            zip: $("#editZip"),
            latitude: $("#editLatitude"),
            longitude: $("#editLongitude"),
        });
    });
});
