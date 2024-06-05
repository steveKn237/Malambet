
function selectMatch(match){
    switch (match) {
        case 1:
            let paramAll = "allMatch";
            let urlAll = `./php/SelectMatch.php?Competition=${encodeURIComponent(paramAll)}`;
            window.location.href = urlAll;
            break;
        case 2:
            let paramLdc = "ldc";
            let urlLdc = `./php/SelectMatch.php?Competition=${encodeURIComponent(paramLdc)}`;
            window.location.href = urlLdc;
            break;
        case 3:
            let paramBundes = "bundes";
            let urlBundes = `./php/SelectMatch.php?Competition=${encodeURIComponent(paramBundes)}`;
            window.location.href = urlBundes;
            break;
        case 4:
            let paramL1 = "L1";
            let urlL1 = `./php/SelectMatch.php?Competition=${encodeURIComponent(paramL1)}`;
            window.location.href = urlL1;
            break;
    }
}