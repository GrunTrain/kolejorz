let map;
let path = "/data/stacje.csv";
let markers = L.featureGroup();

$( document ).ready(function() {
    createMap();
    readCSV();
})

function createMap(){
    map = L.map('map').setView([51.429445, 17.940554], 6);
    L.tileLayer('https://api.maptiler.com/maps/basic-v2/{z}/{x}/{y}.png?key=3jWGVfYX2MWCGk1C4FEu', {
        attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
    }).addTo(map);
}

function readCSV(){
    Papa.parse(path, {
        header: true,
        download: true,
        complete: function(data) {
            mapCSV(data);
        }
    });
}

function mapCSV(data){
    let circleOptions = {
        radius: 5,
        weight: 1,
        color: 'white',
        fillColor: 'dodgerblue',
        fillOpacity: 1
    }

    data.data.forEach(function(item,index){
        let marker = L.circleMarker([item.Latitude,item.Longitude],circleOptions)
            .on('mouseover',function(){
                this.bindPopup(`${item.Title}`)
            })

        markers.addLayer(marker)

        //sends station names to the sidebar
        $('.sidebar').append(
            '<div class="flex flex-col my-4 p-3 bg-gray-800 rounded-lg text-white">' +
            '<div class="flex flex-col space-y-2">' +
            '<p class="font-semibold text-xl">' +
            item.Title +
            '</p>'
        )
    })

    markers.addTo(map)

    map.fitBounds(markers.getBounds())
}
