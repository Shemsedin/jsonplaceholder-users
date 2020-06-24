jQuery(document).ready(function () {
  jQuery('.test').click(function () {
    jQuery('table tr.more-details').remove();
    let current = jQuery(this).parent().parent().index();
    if (jQuery(this).hasClass('clicked')) {
      jQuery(this).removeClass('clicked');
    } else {
      jQuery(this).addClass('clicked');
      current = jQuery(this).parent().parent().index();
      jQuery.ajax({
        url: users_api.endpoint, success: function (response) {
          jQuery("table tr:eq(" + current + ")").after("<tr class='more-details'><td colspan='4'><div>" + userComponent(response[current - 1]) + "</div></td></tr>");
        }
      });
    }
  });

  let userComponent = (response) => {
    let addressTitle   = `<h6>Address</h6>`;
    let CompanyTitle   = `<h6>Company</h6>`;
    let addressDetails = [];
    let companyDetails = [];

    for (const property in response.address) {
      console.log(response.address[property])
      if (property === 'geo') {
        for (const subProperty in response.address[property]) {
          addressDetails.push(`${subProperty}:${response.address[property][subProperty]}`);
        }
      } else {
        addressDetails.push(`${property}: ${response.address[property]}`);
      }
    }

    for (const prop in response.company) {
      companyDetails.push(`${prop}: ${response.company[prop]}`);
    }

    return addressTitle + addressDetails + CompanyTitle + companyDetails;
  }
});
