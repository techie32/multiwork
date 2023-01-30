const slots = ["11:00 am", "12:00 pm", "01:00pm", "02:00 pm"];
const createdAt = "11:30";

console.log(new Date(createdAt));

const v = slots.filter(
    (item) => new Date(item) - new Date(createdAt) > new Date(createdAt)
);

console.log({ v });
