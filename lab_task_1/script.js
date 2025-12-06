const t = document.getElementById("task"),
  a = document.getElementById("add"),
  l = document.getElementById("list"),
  c = document.getElementById("clear");
function load() {
  JSON.parse(localStorage.tasks || "[]").forEach(add);
}
function addTask(x) {
  const li = document.createElement("li");
  li.textContent = x;
  const d = document.createElement("button");
  d.textContent = "Del";
  d.onclick = () => {
    li.remove();
    save();
  };
  li.appendChild(d);
  l.appendChild(li);
}
function save() {
  localStorage.tasks = JSON.stringify(
    [...l.children].map((i) => i.firstChild.textContent)
  );
}
a.onclick = () => {
  if (t.value.trim()) {
    addTask(t.value.trim());
    save();
    alert("Task added!");
    t.value = "";
  }
};
c.onclick = () => {
  if (confirm("Clear all?")) {
    l.innerHTML = "";
    save();
  }
};
load();
