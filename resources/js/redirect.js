const map = {
  "jingbh.top": {
    https: true,
    to: "www.jingbh.top"
  },
  "www.jingbh.top": {
    https: true
  }
}

const host = location.host

for (let need in map) {
  if (host === need) {
    let target = map[host]

    if (typeof target === "string") {
      location.host = target

    } else if (typeof target === "object") {

      if (target.https === true && location.protocol !== "https:") location.protocol = "https:"

      if (target.to && location.host !== target.to) location.host = target.to
    }
  }
}
