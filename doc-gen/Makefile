generate-json: update-girs libdoclet.so
	rm -rf docs
	G_MESSAGES_DEBUG=all valadoc \
		-o docs \
		--girdir girs/gir-1.0/ \
		--vapidir girs/vala/vapi/ \
		--doclet . \
		--driver 0.30 \
		--deps

libdoclet.so: JsonDoclet.vala
	valac -C --pkg valadoc-1.0 --pkg libxml-2.0 JsonDoclet.vala
	gcc -shared -fPIC -o libdoclet.so JsonDoclet.c $(shell pkg-config --cflags --libs valadoc-1.0 libxml-2.0)
	rm JsonDoclet.c

update-girs:
	if test -d girs; then \
		cd girs ; \
		git pull ; \
		cd .. ; \
	else \
		git clone https://github.com/nemequ/vala-girs.git girs ; \
	fi