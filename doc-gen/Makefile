generate-json: update-girs jsondoclet.so
	rm -rf docs
	valadoc \
		-o docs \
		--girdir girs/gir-1.0/ \
		--vapidir girs/vala/vapi/ \
		--doclet . \
		--driver 0.30

jsondoclet.so: JsonDoclet.vala
	valac -C --pkg valadoc-1.0 --pkg json-glib-1.0 JsonDoclet.vala
	gcc -shared -fPIC -o libdoclet.so JsonDoclet.c `pkg-config --cflags --libs valadoc-1.0 json-glib-1.0`
	rm JsonDoclet.c

update-girs:
	if test -d girs; then \
		cd girs ; \
		git pull ; \
		cd .. ; \
	else \
		git clone https://github.com/nemequ/vala-girs.git girs ; \
	fi