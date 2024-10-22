const expandBtns = document.querySelectorAll(".expand-btn");

expandBtns.forEach(btn => {
  btn.addEventListener("click", () => {
    const boxContent = btn.parentElement.nextElementSibling;

    if (boxContent.style.display === "none") {
      boxContent.style.display = "block";
      btn.innerText = "-";
    } else {
      boxContent.style.display = "none";
      btn.innerText = "+";
    }
  });
});
