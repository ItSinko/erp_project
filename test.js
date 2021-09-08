var obj = {
    a: 1,
    b: 2,
    c: function () {
        console.log(test);
    },
    get d() {
        return this.a;
    }
}

obj = [1, , 3];
obj.length = 10;
console.log(obj.length);

obj.forEach((element, index) => {
    console.log(element);
});